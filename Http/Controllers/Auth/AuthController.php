<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Models\UserNotificationPermission;
use App\Models\Wallet;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        return $this->withErrorHandling(function () use ($request) {
            $auth = app('firebase.auth');
            $idTokenString = $request->input('firebase_token');
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);
            $uid = $verifiedIdToken->claims()->get('sub');

            $user = User::where('firebase_uid',$uid)->first();
            $phone = $verifiedIdToken->claims()->get('firebase')['identities']['phone'];


            if (!$user) {
                $user = User::create([
                    'firebase_uid' => $uid,
                    'phone' => $phone[0],
                    'phone_verified_at' => now(),
                    'last_activated_at' => now(),
                    'registration_completed' => false,
                ]);
                if ($request->thumb) {
                    $user->addMedia($request->thumb)->toMediaCollection('thumb');
                }
                UserNotificationPermission::create([
                    'user_id'=>$user->id
                ]);
                Wallet::create([
                    'walletable_type'=>'App\Models\User',
                    'walletable_id'=>$user->id,
                    'balance'=>0
                ]);
            }
            $tokenResult = $user->createToken('Firebase');
            // Store the created token
            $token = $tokenResult->token;

            // Save the token to the user
            $token->save();
            return response()->success(
                data: [
                    'access_token' => $tokenResult->accessToken,
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString(),
                    'user' => new UserResource($user),
                ]
            );
        });
    }

    public function logout(){
        return $this->withErrorHandling(function (){
            auth()->user()->token()->revoke();
            return response()->success(data: [], message: null, status: 204);
        });
    }
}

