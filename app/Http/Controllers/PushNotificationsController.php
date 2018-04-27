<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PushNotificationCreateRequest;
use App\Http\Requests\PushNotificationUpdateRequest;
use App\Repositories\PushNotificationRepository;
use App\Validators\PushNotificationValidator;

/**
 * Class PushNotificationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PushNotificationsController extends Controller
{
    /**
     * @var PushNotificationRepository
     */
    protected $repository;

    /**
     * @var PushNotificationValidator
     */
    protected $validator;

    /**
     * PushNotificationsController constructor.
     *
     * @param PushNotificationRepository $repository
     * @param PushNotificationValidator $validator
     */
    public function __construct(PushNotificationRepository $repository, PushNotificationValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return response()->json($this->repository->with(['sender'])->all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PushNotificationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PushNotificationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $pushNotification = $this->repository->create($request->all());

            $response = [
                'message' => 'PushNotification created.',
                'data'    => $pushNotification->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $pushNotification = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pushNotification,
            ]);
        }

        return view('pushNotifications.show', compact('pushNotification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pushNotification = $this->repository->find($id);

        return view('pushNotifications.edit', compact('pushNotification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PushNotificationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PushNotificationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $pushNotification = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PushNotification updated.',
                'data'    => $pushNotification->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'PushNotification deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PushNotification deleted.');
    }
}
