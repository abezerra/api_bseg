<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SMSListCreateRequest;
use App\Http\Requests\SMSListUpdateRequest;
use App\Repositories\SMSListRepository;
use App\Validators\SMSListValidator;

/**
 * Class SMSListsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SMSListsController extends Controller
{
    /**
     * @var SMSListRepository
     */
    protected $repository;

    /**
     * @var SMSListValidator
     */
    protected $validator;

    /**
     * SMSListsController constructor.
     *
     * @param SMSListRepository $repository
     * @param SMSListValidator $validator
     */
    public function __construct(SMSListRepository $repository, SMSListValidator $validator)
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
        $sMSLists = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sMSLists,
            ]);
        }

        return view('sMSLists.index', compact('sMSLists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SMSListCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SMSListCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $sMSList = $this->repository->create($request->all());

            $response = [
                'message' => 'SMSList created.',
                'data'    => $sMSList->toArray(),
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
        $sMSList = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sMSList,
            ]);
        }

        return view('sMSLists.show', compact('sMSList'));
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
        $sMSList = $this->repository->find($id);

        return view('sMSLists.edit', compact('sMSList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SMSListUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SMSListUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $sMSList = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SMSList updated.',
                'data'    => $sMSList->toArray(),
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
                'message' => 'SMSList deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'SMSList deleted.');
    }
}
