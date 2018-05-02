<?php

namespace App\Http\Controllers;

use Auth;
use App\Entities\Chats;
use App\Entities\Client;
use App\Entities\PushNotification;
use App\Entities\User;
use App\Events\ChatEvent;
use App\Notifications\PushToAll;
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
      //dd(Auth::user()->id);
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
          //  broadcast( new ChatEvent($conversation, $user))->toOthers();


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

    public function push(ConversationCreateRequest $request)
    {
        $data = $request->all();
        $content      = array(
            "en" => $data['message'],

        );
        $heading = array(
            "en" => $data['heading']
        );

        $subtitle = array(
            "en" => $data['subtitle']
        );

        $url = array(
            "en" => "url"
        );
        $hashes_array = array();
        array_push($hashes_array, array(
            "id" => "like-button",
            "text" => "Like",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url" => "https://brasal.com.br"
        ));
        array_push($hashes_array, array(
            "id" => "like-button-2",
            "text" => "Like2",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url" => "https://yoursite.com"
        ));
        $fields = array(
            'app_id' => "d080bcee-26b9-46b3-b7ae-02371fb58874",
            'included_segments' => array(
                'All'
            ),
            'data' => array(
                "foo" => "bar",
                'subtitle' => 'Subtitle'
            ),
            'contents' => $content,
            'web_buttons' => $hashes_array,
            'headings' => $heading,
            'subtitle' => $subtitle,
            'url' => $url,
        );

        $fields = json_encode($fields);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ZGVlNjRhMjItYjVjOS00MzNmLTgxOWYtMzc2YjMyMmNhZDgw'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        PushNotification::create([
            'heading' => $data['heading'],
            'subtitle' => $data['subtitle'],
            'message' => $data['message'],
            'sended_by' => $data['sended_by'],
        ]);

        return $response;
    }
}
