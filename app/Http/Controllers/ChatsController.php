<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ChatsCreateRequest;
use App\Http\Requests\ChatsUpdateRequest;
use App\Repositories\ChatsRepository;
use App\Validators\ChatsValidator;

/**
 * Class ChatsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ChatsController extends Controller
{
    /**
     * @var ChatsRepository
     */
    protected $repository;

    /**
     * @var ChatsValidator
     */
    protected $validator;

    /**
     * ChatsController constructor.
     *
     * @param ChatsRepository $repository
     * @param ChatsValidator $validator
     */
    public function __construct(ChatsRepository $repository, ChatsValidator $validator)
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
        $chats = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $chats,
            ]);
        }

        return view('chats.index', compact('chats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ChatsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ChatsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $chat = $this->repository->create($request->all());


            $response = [
                'message' => 'Chats created.',
                'data'    => $chat->toArray(),
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
        $chat = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $chat,
            ]);
        }

        return view('chats.show', compact('chat'));
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
        $chat = $this->repository->find($id);

        return view('chats.edit', compact('chat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ChatsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ChatsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $chat = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Chats updated.',
                'data'    => $chat->toArray(),
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
                'message' => 'Chats deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Chats deleted.');
    }
}
