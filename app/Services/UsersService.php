<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 06/03/2018
 * Time: 10:05
 */

namespace App\Services;


use App\Entities\User;
use App\Validators\UserValidator;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;

class UsersService
{
    /**
     * @var UserValidator
     */
    private $validator;
    /**
     * @var NotificationService
     */
    private $notificationService;
    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct(UserValidator $validator,
                                NotificationService $notificationService,
                                ClientService $clientService)
    {
        $this->validator = $validator;
        $this->notificationService = $notificationService;
        $this->clientService = $clientService;
    }

    /**
     * @return return all users
     */
    public function index()
    {
        return DB::table('users')->get();
    }

    public function create_new_with_policy(array $data)
    {

        $inser_id = DB::table('users')->insertGetId(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'cpf' => $data['cpf'],
                'role' => $data['role']
            ]
        );

        //notify the manager
        $user = DB::table('users')->where('role', '=', 'manager')->get();

        foreach ($user as $item) {
            $userid = $item->id;
        }
        $notification = $this->notificationService->notify_new_possible_client($userid, $data['cpf']);

        //register client
        $data['user_id'] = $inser_id;

        $client = $this->clientService->store($data);

        try {
            $this->validator->with($data)->passesOrFail();
            return [
                'code' => 200,
                'action' => $inser_id,
                'notification' => $notification,
                'client' => $client,
                'message' => 'User has been created'
            ];
        } catch (ValidationException $exception) {
            return [
                'erro' => 'Validation error',
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];
        }

    }


    public function user_responsible_of_news_clients()
    {
        return DB::table('users')->where('role', '=', 'news')->get();

    }

}