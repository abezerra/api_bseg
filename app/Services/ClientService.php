<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 05/03/2018
 * Time: 11:32
 */

namespace App\Services;


use App\Repositories\ClientRepository;
use App\Validators\ClientValidator;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;

class ClientService
{
    /**
     * @var ClientRepository
     */
    private $repository;
    /**
     * @var ClientValidator
     */
    private $validator;
    /**
     * @var NotificationService
     */
    private $notificationService;

    public function __construct(ClientRepository $repository,
                                ClientValidator $validator,
                                NotificationService $notificationService)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        return $this->repository->with(['user', 'auto'])->all();
    }

    public function client()
    {
        return $this->repository->with(['user'])->findByField(['type' => '1']);
    }

    public function lead()
    {
        return $this->repository->with(['user'])->findByField(['type' => '0']);
    }

    public function store(array $data)
    {
        try
        {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
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

    public function update(array $data, $id)
    {
        try
        {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
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

    public function destroy($id)
    {
        return [
            'code' => '200',
            'action' => $this->repository->delete($id),
            'message' => 'Client has been deleted'
        ];
    }

    public function his_client($cpf)
    {
        return $this->repository->findByField('cpf', $cpf);
    }

    public function store_from_upload_policy(array $data)
    {
        //create the user from client
        $default_password = "Mudar123#";
        $inser_id = DB::table('users')->insertGetId(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($default_password),
                'cpf' => $data['cpf'],
                'role' => 'client'
            ]
        );

        $data['user_id'] = $inser_id;

        //notify the client
        $notification = [];
        $notification['name'] = $data['name'];
        $notification['email'] = $data['email'];
        $notification['user_id'] = $inser_id;

        $this->notificationService->send_user_and_password_to_client($notification);

        //define type of client
        $data['type'] = 1;
        //save cleint
        return $this->repository->create($data);
    }
}