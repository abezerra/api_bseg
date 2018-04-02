<?php

namespace App\Http\Controllers;

use App\Services\MessaReplyService;
use App\Http\Requests\MessageReplyCreateRequest;
use App\Repositories\MessageReplyRepository;
use App\Validators\MessageReplyValidator;

/**
 * Class MessageRepliesController.
 *
 * @package namespace App\Http\Controllers;
 */
class MessageRepliesController extends Controller
{
    /**
     * @var MessaReplyService
     */
    private $service;

    /**
     * MessageRepliesController constructor.
     *
     * @param MessageReplyRepository $repository
     * @param MessageReplyValidator $validator
     */
    public function __construct(MessaReplyService $service)
    {
        $this->service = $service;
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
     * @param  MessageReplyCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MessageReplyCreateRequest $request)
    {
        return $this->service->store($request->all());
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

    public function my_replyes($id)
    {
        return $this->service->my_replyes($id);
    }
}
