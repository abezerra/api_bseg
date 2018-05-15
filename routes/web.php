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
    return view('welcome');
//    $query = http_build_query([
//       'client_id' => '3',
//       'redirect_uri' => 'http://localhost:9999/callback',
//        'response_type' =>  'code',
//        'scope' => ''
//    ]);
//
//    return redirect("http://127.0.0.1:8000/oauth/authorize?$query");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/security', 'SecurityController@index')->name('security');
Route::get('/callback', 'SecurityController@callback')->name('callback');
Route::get('test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "enviado";
});

Route::get('callback', function() {});

Route::get('/terminar-pagamento', function () {
    //cadastrar order no banco de dados
    //enviar para expedição
    //enviar para e-mail
    //push notification
    $notificationBuilder = new \LaravelFCM\Message\PayloadNotificationBuilder();
    $notificationBuilder->setTitle('Sua compra foi realizada com sucesso')
        ->setBody('Seu tênis da SON irá chegar em breve');
    $notification = $notificationBuilder->build();
    $dataBuilder = new \LaravelFCM\Message\PayloadDataBuilder();
    //$dataBuilder->addData()
    $data = $dataBuilder->build();
    //tabela devices
    $token = 'AAAAr-hXtPQ:APA91bG0bXIGNmG3_7W4q6Kf0bp9UzKbz1OY-QqjTiv0j3c5QP5IyWgZ2pzZEzRzvcxlqj6kr41VH981Oj9Xf7JW07I9SSt3cz6-v1toSt9T1gvxefd3xRfRE9Id1z0usQZANvqfC0dJ';
    //\FCM::sendTo($token, null, $notification, null);
    $k = \FCM::sendTo($token, null, $notification, $data);
    dd($k);
});


Route::group(['prefix' => 'mailer'], function () {
    Route::get('/template', 'MailerTemplatesController@template');
});