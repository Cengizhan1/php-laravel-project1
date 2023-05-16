<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\NotificationPermissionRequest;
use App\Http\Resources\User\NotificationPermissionResource;
use App\Models\UserNotificationPermission;
use Illuminate\Http\Request;

class UserNotificationPermissionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->withErrorHandling(function (){
            return response()->success(0,null, NotificationPermissionResource::make(auth()->user()->permission),201);
        });
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(NotificationPermissionRequest $request)
    {
        return $this->withErrorHandling(function () use ($request) {
             auth()->user()->permission->update(
                [
                    'sms_notification' => $request->get('sms_notification'),
                    'email_notification' => $request->get('email_notification'),
                    'app_notification' => $request->get('app_notification'),
                ]);
            return response()->success(0,null, NotificationPermissionResource::make(auth()->user()->permission),201);
        });
    }
}
