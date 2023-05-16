<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        return $this->withErrorHandling(function () {
            return new UserResource(auth()->user());
        });
    }

    public function update(UpdateRequest $request)
    {

        return $this->withErrorHandling(function () use ($request) {
            $user = $request->user('user')->update(
                [
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'gender' => $request->get('gender'),
                    'bank_name' => $request->get('bank_name'),
                    'iban' => $request->get('iban'),
                    'birth_date'=>$request->get('birth_date'),
                    'firebase_device_token' => $request->get('firebase_device_token'),
                    'registration_completed' => true,
                    'last_active_at' => now(),
                ]);

            if ($request->thumb) {
                $request->user('customer')->clearMediaCollection('avatar');
                $request->user('customer')->addMedia($request->thumb)->toMediaCollection('avatar');
            }
            return response()->success(0,null,new UserResource($request->user()),201);
        });


    }
    public function changeAccount(){
        return $this->withErrorHandling(function () {
            auth()->user()->update([
                'supervisor_active'=>!auth()->user()->supervisor_active
            ]);
            return response()->success(0,null,auth()->user()->supervisor_active,201);
        });
    }


    protected function withErrorHandling2($callback)
    {
        try {
            return $callback();
        } catch (\Exception $exception) {
            return response()->error(
                code: $exception->getCode(),
                message: $exception->getMessage(),
                data: [],
                status: 500
            );
        }
    }
    public function devicetoken(Request $request)
    {

        return $this->withErrorHandling(function ()use($request){
            auth()->user()->update([
                'firebase_device_token'=>$request->devicetoken
            ]);
        });
    }


    public function destroy(Request $request)
    {
        return $this->withErrorHandling(function () use ($request) {

            auth()->user()->update([
                'is_delete'=>true
            ]);
            return response()->success(0,null,[],201);
        });
    }
}
