<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SmsCreateRequest;
use App\Http\Requests\SmsUpdateRequest;
use App\Repositories\SmsRepository;
use App\Validators\SmsValidator;

/**
 * Class SmsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SmsController extends Controller
{
    /**
     * @var SmsRepository
     */
    protected $repository;

    /**
     * @var SmsValidator
     */
    protected $validator;

    /**
     * SmsController constructor.
     *
     * @param SmsRepository $repository
     * @param SmsValidator $validator
     */
    public function __construct(SmsRepository $repository, SmsValidator $validator)
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
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $sms = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sms,
            ]);
        }

        return view('sms.index', compact('sms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SmsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SmsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $sm = $this->repository->create($request->all());

            $response = [
                'message' => 'Sms created.',
                'data'    => $sm->toArray(),
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
        $sm = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sm,
            ]);
        }

        return view('sms.show', compact('sm'));
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
        $sm = $this->repository->find($id);

        return view('sms.edit', compact('sm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SmsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SmsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $sm = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Sms updated.',
                'data'    => $sm->toArray(),
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
                'message' => 'Sms deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Sms deleted.');
    }
}
