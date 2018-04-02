<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 26/03/2018
 * Time: 15:42
 */

namespace App\Services;


use App\Repositories\MessageReplyRepository;
use App\Validators\MessageReplyValidator;

class MessaReplyService
{
    /**
     * @var MessageReplyRepository
     */
    private $repository;
    /**
     * @var MessageReplyValidator
     */
    private $validator;

    /**
     * MessaReplyService constructor.
     * @param MessageReplyRepository $repository
     * @param MessageReplyValidator $validator
     */
    public function __construct(MessageReplyRepository $repository, MessageReplyValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }


    public function index()
    {
        return $this->repository->all();
    }

    public function store(array $data)
    {
        try
        {
            return response()->json(['success' => $this->repository->create($data)], 200);
        }
        catch (ValidationException $exception)
        {
            return [
                'erro'=> 'Validation error',
                'code' => $exception->getCode(),
                'message'=> $exception->getMessage()
            ];
        }
    }

    public function update(array $data, $id)
    {
        try
        {
            $this->validator->with($data)->passesOrFail();
            return [
                'code' => 200,
                'action' => $this->repository->update($data, $id),
                'message' => 'Message has been created'
            ];
        }
        catch (ValidationException $exception)
        {
            return [
                'erro'=> 'Validation error',
                'code' => $exception->getCode(),
                'message'=> $exception->getMessage()
            ];
        }
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function destroy($id)
    {
        return [
            'code' => '200',
            'action' => $this->repository->delete($id),
            'message' => 'Message been deleted'
        ];
    }

    public function my_replyes($id)
    {
        return $this->repository->with(['users'])->findByField('replyer_id', $id);
    }
}