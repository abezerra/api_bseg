<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('dp', 'DepartamentsController@index')->middleware('auth:api');

Route::group(['middleware' => ['cors']], function () {
    Route::post('authenticate', 'AuthController@auth');
    Route::get('authenticateds', 'AuthController@getAuthenticatedUser');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::get('details/{cpf}', 'AuthController@details');
        Route::post('invite', 'FiendsController@invite');
//        Route::get('user_responsible_of_news_clients', 'UsersController@user_responsible_of_news_clients');
//        Route::post('user_add', 'UsersController@create_new');
//        Route::get('notification', 'NotificationsController@index');

        Route::group(['prefix' => 'clients'], function () {
            Route::get('', 'ClientsController@index');
            Route::get('/client', 'ClientsController@client');
            Route::get('/leads', 'ClientsController@lead');
            Route::post('', 'ClientsController@store');
            Route::get('/{id}', 'ClientsController@show');
            Route::put('/{id}', 'ClientsController@update');
            Route::delete('/{id}', 'ClientsController@destroy');
        });

        Route::group(['prefix' => 'alerts'], function () {
            Route::get('', 'AlertsController@index');
            Route::get('/my/{id}', 'AlertsController@my_alerts');
            Route::post('', 'AlertsController@store');
            Route::get('/{id}', 'AlertsController@show');
            Route::put('/{id}', 'AlertsController@update');
            Route::delete('/{id}', 'AlertsController@destroy');
        });


        Route::group(['prefix' => 'notifications'], function () {
            Route::get('/{cpf}', 'NotificationsController@index');
            Route::get('/client', 'ClientsController@client');
            Route::get('/leads', 'ClientsController@lead');
            Route::post('/sms', 'SmsController@store');
            Route::get('/{id}', 'ClientsController@show');
            Route::put('/{id}', 'ClientsController@update');
            Route::delete('/{id}', 'ClientsController@destroy');
            Route::get('', 'NotificationsController@pusher');
        });

        //insurances routes
        Route::group(['prefix' => 'auto'], function () {
            Route::get('', 'AutoInsurancesController@index');
            Route::get('/my/{id}', 'AutoInsurancesController@my_alerts');
            Route::post('', 'AutoInsurancesController@store');
            Route::get('/{id}', 'AutoInsurancesController@show');
            Route::put('/{id}', 'AutoInsurancesController@update');
            Route::delete('/{id}', 'AutoInsurancesController@destroy');
        });

        Route::group(['prefix' => 'eo'], function () {
            Route::get('', 'EOInsurancesController@index');
            Route::get('/my/{id}', 'EOInsurancesController@my_alerts');
            Route::post('', 'EOInsurancesController@store');
            Route::get('/{id}', 'EOInsurancesController@show');
            Route::put('/{id}', 'EOInsurancesController@update');
            Route::delete('/{id}', 'EOInsurancesController@destroy');
        });

        Route::group(['prefix' => 'life'], function () {
            Route::get('', 'IndividualLifeInsurancesController@index');
            Route::get('/my/{id}', 'IndividualLifeInsurancesController@my_alerts');
            Route::post('', 'IndividualLifeInsurancesController@store');
            Route::get('/{id}', 'IndividualLifeInsurancesController@show');
            Route::put('/{id}', 'IndividualLifeInsurancesController@update');
            Route::delete('/{id}', 'IndividualLifeInsurancesController@destroy');
        });

        Route::group(['prefix' => 'lease'], function () {
            Route::get('', 'LeaseBoundInsurancesController@index');
            Route::get('/my/{id}', 'LeaseBoundInsurancesController@my_alerts');
            Route::post('', 'LeaseBoundInsurancesController@store');
            Route::get('/{id}', 'LeaseBoundInsurancesController@show');
            Route::put('/{id}', 'LeaseBoundInsurancesController@update');
            Route::delete('/{id}', 'LeaseBoundInsurancesController@destroy');
        });

        Route::group(['prefix' => 'residential'], function () {
            Route::get('', 'ResidentialInsurancesController@index');
            Route::get('/my/{id}', 'ResidentialInsurancesController@my_alerts');
            Route::post('', 'ResidentialInsurancesController@store');
            Route::get('/{id}', 'ResidentialInsurancesController@show');
            Route::put('/{id}', 'ResidentialInsurancesController@update');
            Route::delete('/{id}', 'ResidentialInsurancesController@destroy');
        });

        //insurers
        Route::group(['prefix' => 'insurers'], function () {
            Route::get('', 'InsurersController@index');
            Route::get('/my/{id}', 'InsurersController@my_alerts');
            Route::post('', 'InsurersController@store');
            Route::get('/{id}', 'InsurersController@show');
            Route::put('/{id}', 'InsurersController@update');
            Route::delete('/{id}', 'InsurersController@destroy');
        });


        Route::group(['prefix' => 'broker'], function () {
            Route::get('', 'BrokersController@index');
            Route::post('', 'BrokersController@store');
            Route::get('/{id}', 'BrokersController@show');
            Route::put('/{id}', 'BrokersController@update');
            Route::delete('/{id}', 'BrokersController@destroy');
            //to departaments of broker
            Route::get('/departament/{id}', 'DepartamentsController@show');
            Route::put('/departament/{id}', 'DepartamentsController@update');
            Route::delete('/departament/{id}', 'DepartamentsController@destroy');
        });


        Route::group(['prefix' => 'departaments'], function () {
            Route::get('', 'DepartamentsController@index');
            Route::get('/my/{id}', 'DepartamentsController@my_alerts');
            Route::post('', 'DepartamentsController@store');
            Route::get('/{id}', 'DepartamentsController@show');
            Route::put('/{id}', 'DepartamentsController@update');
            Route::delete('/{id}', 'DepartamentsController@destroy');
        });


        Route::group(['prefix' => 'friend'], function () {
            Route::get('', 'FiendsController@index');
            Route::get('/my/{id}', 'FiendsController@my_alerts');
            Route::post('', 'FiendsController@store');
            Route::get('/{id}', 'FiendsController@show');
            Route::put('/{id}', 'FiendsController@update');
            Route::delete('/{id}', 'FiendsController@destroy');
        });

        Route::group(['prefix' => 'insured'], function () {
            Route::get('/{id}', 'IsuredController@my_insurances');
        });

        Route::get('push', 'InsurersController@send_push');

        Route::post('templating', 'TemplatingsController@create_templates');
        Route::post('image', 'TemplatingsController@image_templating');

        Route::group(['prefix' => 'medias'], function () {
            Route::get('/{id}', 'TemplatingsController@show');
        });

        Route::group(['prefix' => 'messages'], function () {
            Route::get('', 'MessagesController@index');
            Route::get('/my_messages/{id}', 'MessagesController@my_messages');
            Route::post('', 'MessagesController@store');
            Route::get('/{id}', 'MessagesController@show');
            Route::put('/{id}', 'MessagesController@update');
            Route::post('reply/{id}', 'MessageRepliesController@store');
            Route::post('my_reply/{id}', 'MessageRepliesController@store');
            Route::delete('/{id}', 'MessagesController@destroy');
        });

        Route::group(['prefix' => 'templatings'], function () {
            Route::get('defaults', 'DefaultsTemplatingsController@index');
            Route::post('defaults', 'DefaultsTemplatingsController@store');
            Route::get('defaults/{id}', 'DefaultsTemplatingsController@show');
            Route::put('defaults/{id}', 'DefaultsTemplatingsController@update');
            Route::delete('defaults/{id}', 'DefaultsTemplatingsController@destroy');
        });

        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('all', 'DashboardController@all_insurances_of_dashboard');
            Route::get('is_active', 'DashboardController@is_active');
            Route::get('renew_over_the_next_thirty_days', 'DashboardController@renew_over_the_next_thirty_days');
            Route::get('total_hired', 'DashboardController@total_hired');
        });
    });
});

