<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ConversationCreateRequest;
use App\Http\Requests\ConversationUpdateRequest;
use App\Repositories\ConversationRepository;
use App\Validators\ConversationValidator;

/**
 * Class ConversationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ConversationsController extends Controller
{
    /**
     * @var ConversationRepository
     */
    protected $repository;

    /**
     * @var ConversationValidator
     */
    protected $validator;

    /**
     * ConversationsController constructor.
     *
     * @param ConversationRepository $repository
     * @param ConversationValidator $validator
     */
    public function __construct(ConversationRepository $repository, ConversationValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $conversations = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $conversations,
            ]);
        }

        return view('conversations.index', compact('conversations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ConversationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ConversationCreateRequest $request)
    {
        try {

            $conversation = $this->repository->create($request->all());

            $response = [
                'message' => 'Conversation created.',
                'data' => $conversation->toArray(),
            ];

            return response()->json($response, 201);
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);

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
        $conversation = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $conversation,
            ]);
        }

        return view('conversations.show', compact('conversation'));
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
        $conversation = $this->repository->find($id);

        return view('conversations.edit', compact('conversation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ConversationUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ConversationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $conversation = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Conversation updated.',
                'data' => $conversation->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
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
                'message' => 'Conversation deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Conversation deleted.');
    }

    public function history($id)
    {
        return $this->repository->with(['receiver', 'sender'])->findByField('receiver_id', $id);
    }
}
