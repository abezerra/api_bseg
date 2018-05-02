<?php

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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('per-to-per-chat', function ($user, $id) {
    return true;
    //return Auth::check();
});

//private chanell
//Broadcast::channel('per-to-per-chat.{id}', function ($user, $id) {
//    return $user;
//});
