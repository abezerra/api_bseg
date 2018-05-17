<?php

namespace App\Http\Controllers;

use App\Entities\Message;
use App\Services\MessageService;
use Illuminate\Http\Request;
use App\Http\Requests\MessageCreateRequest;
use App\Repositories\MessageRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/**
 * Class MessagesController.
 *
 * @package namespace App\Http\Controllers;
 */
class MessagesController extends Controller
{

    /**
     * @var MessageService
     */
    private $service;
    /**
     * @var MessageRepository
     */
    private $repository;

    public function __construct(MessageService $service, MessageRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->service->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MessageCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        if (isset($data['attachmet'])) {
            $photoName = time() . '.' . $request->attachmet->getClientOriginalExtension();
            $request->attachmet->move(public_path('messages'), $photoName);

            $data['attachmet'] = "https://api-bseg.brasal.com.br/messages/{$photoName}";
        }
        $message = $this->repository->create($data);

        Mail::raw($data['message'], function ($message) use ($data) {
            $message->subject($data['subject']);
            $message->from('alsene@brasal.com.br', 'Alsene da Brasal Corretora');
            $message->to('galima@brasal.com.br');
        });

        return response()->json(['data' => $message], 200);
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
        return $this->service->show($id);
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
        return $this->service->destroy($id);
    }

    public function my_messages($id)
    {
        return Message::with(['users', 'replies'])
            ->where('user_id', '=', $id)
            ->get(['id', 'message', 'subject', 'user_id', 'phone'])
            ->last();
    }
}
