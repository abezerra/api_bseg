<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MailerListCreateRequest;
use App\Http\Requests\MailerListUpdateRequest;
use App\Repositories\MailerListRepository;
use App\Validators\MailerListValidator;

/**
 * Class MailerListsController.
 *
 * @package namespace App\Http\Controllers;
 */
class MailerListsController extends Controller
{
    /**
     * @var MailerListRepository
     */
    protected $repository;

    /**
     * @var MailerListValidator
     */
    protected $validator;

    /**
     * MailerListsController constructor.
     *
     * @param MailerListRepository $repository
     * @param MailerListValidator $validator
     */
    public function __construct(MailerListRepository $repository, MailerListValidator $validator)
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
        $mailerLists = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mailerLists,
            ]);
        }

        return view('mailerLists.index', compact('mailerLists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MailerListCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MailerListCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $mailerList = $this->repository->create($request->all());

            $response = [
                'message' => 'MailerList created.',
                'data'    => $mailerList->toArray(),
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
        $mailerList = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mailerList,
            ]);
        }

        return view('mailerLists.show', compact('mailerList'));
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
        $mailerList = $this->repository->find($id);

        return view('mailerLists.edit', compact('mailerList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MailerListUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MailerListUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $mailerList = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MailerList updated.',
                'data'    => $mailerList->toArray(),
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
                'message' => 'MailerList deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'MailerList deleted.');
    }
}
