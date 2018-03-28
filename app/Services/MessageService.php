<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 26/03/2018
 * Time: 14:25
 */

namespace App\Services;

use App\Repositories\MessageRepository;
use App\Validators\MessageValidator;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Log;

class MessageService
{
    /**
     * @var MessageRepository
     */
    private $repository;
    /**
     * @var MessageValidator
     */
    private $validator;

    public function __construct(MessageRepository $repository, MessageValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function index()
    {
        return $this->repository->with(['replies', 'users'])->all();
    }

    public function store(array $data)
    {
        try
        {
            $message = $this->repository->create($data);
            return response()->json(['a porra do maldito sucesso' => $message], 200);
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
        return $this->repository->with(['replies', 'users'])->find($id);
    }

    public function destroy($id)
    {
        return [
            'code' => '200',
            'action' => $this->repository->delete($id),
            'message' => 'Message been deleted'
        ];
    }

    public function my_messages($id)
    {
        return $this->repository->with(['users'])->findByField('user_id', $id);
    }
}