<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use App\Http\Requests\NotificationCreateRequest;
use App\Http\Requests\NotificationUpdateRequest;
use Davibennun\LaravelPushNotification\PushNotification;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use Pusher\Pusher;


/**
 * Class NotificationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class NotificationsController extends Controller
{

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->service->index($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  NotificationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(NotificationCreateRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  NotificationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(NotificationUpdateRequest $request, $id)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function onesignal()
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('O titulo da minha notifciacao');
        $notificationBuilder->setTitle('Corpo da minha push notification')->setSound('default');


        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => '10/10/1910']);


        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();


        $token = "AAAAr-hXtPQ:APA91bG0bXIGNmG3_7W4q6Kf0bp9UzKbz1OY-QqjTiv0j3c5QP5IyWgZ2pzZEzRzvcxlqj6kr41VH981Oj9Xf7JW07I9SSt3cz6-v1toSt9T1gvxefd3xRfRE9Id1z0usQZANvqfC0dJ";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();


        $downstreamResponse->tokensToDelete();
        $downstreamResponse->tokensToModify();
        $downstreamResponse->tokensToRetry();
    }

    public function pusher()
    {
        $options = array(
            'cluster' => 'us2',
            'encrypted' => true
        );

        $pusher = new Pusher(
            'b1c9dfd0226ff506116d',
            'b5489d77641c1e4d77fb',
            '491393',
            $options
        );

        $data['message'] = 'lucirano message';
        $k = $pusher->trigger('my-channel', 'my-event', $data);
    }

}
