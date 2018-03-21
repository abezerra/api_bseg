<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    $query = http_build_query([
       'client_id' => '3',
       'redirect_uri' => 'http://localhost:9999/callback',
        'response_type' =>  'code',
        'scope' => ''
    ]);

    return redirect("http://127.0.0.1:8000/oauth/authorize?$query");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/security', 'SecurityController@index')->name('security');
Route::get('/callback', 'SecurityController@callback')->name('callback');
Route::get('test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "enviado";
});

Route::get('callback', function() {
});

