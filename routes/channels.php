<?php

use Illuminate\Support\Facades\Broadcast;

use App\Models\SubstituteRequest;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{id}', function ($user, $id) {
    return ((int)$user->id === (int)SubstituteRequest::Find($id)->user_id || (int)$user->id === (int)SubstituteRequest::Find($id)->deputy_id);
});