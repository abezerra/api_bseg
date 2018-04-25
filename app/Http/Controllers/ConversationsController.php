<?php

namespace App\Http\Controllers;

use App\Entities\Chats;
use App\Entities\Client;
use App\Entities\User;
use App\Events\ChatEvent;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ConversationCreateRequest;
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

    public function store(ConversationCreateRequest $request)
    {
        try {
            $data = $request->all();

            $chat_history = (new Chats)->newQuery()->where('client_id', '=', $data['client_id'])->get();
            $chat_history = $chat_history->toArray();


            if(count($chat_history) <= 0){
                $chat = Chats::create([
                    'clerck_id' => $data['clerck_id'],
                    'client_id' => $data['client_id'],
                ]);

                $data['chats_id'] = $chat['id'];
            }else {
                $data['chats_id'] = $chat_history[0]['id'];
            }



            $conversation = $this->repository->create($data);

            $user = (new User)->newQuery()->find($data['user_id']);

            $event = new ChatEvent($conversation, $user);


            event($event);

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


    public function history($id)
    {
        $conversation = (new Chats)
                                    ->newQuery()
                                    ->with(['chat_messages', 'client', 'clerck'])
                                    ->where('client_id', '=', $id)
                                    ->get();

        $client = (new Client)->newQuery()->where('user_id', '=', $id)->get();

        return response()->json(['client' => $client, 'historic_conversation' => $conversation], 200);
    }
}
