<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 05/03/2018
 * Time: 14:21
 */

namespace App\Services;


use App\Repositories\NotificationRepository;
use App\Validators\NotificationValidator;

class NotificationService
{
    /**
     * @var NotificationRepository
     */
    private $repository;
    /**
     * @var NotificationValidator
     */
    private $validator;
    /**
     * @var SmsService
     */
    private $smsService;
    /**
     * @var MailerService
     */
    private $mailerService;


    public function __construct(NotificationRepository $repository,
                                NotificationValidator $validator,
                                SmsService $smsService,
                                MailerService $mailerService)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->smsService = $smsService;
        $this->mailerService = $mailerService;
    }

    public function index()
    {
        return $this->repository->paginate(5);
    }

    public function store(array $data)
    {
        try
        {
            $this->validator->with($data)->passesOrFail();
            return [
                'code' => 200,
                'action' => $this->repository->create($data),
                'message' => 'Notification has been created'
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

    public function update(array $data, $id)
    {
        try
        {
            $this->validator->with($data)->passesOrFail();
            return [
                'code' => 200,
                'action' => $this->repository->update($data, $id),
                'message' => 'Notification has been created'
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

    public function destroy($id)
    {
        return [
            'code' => '200',
            'action' => $this->repository->delete($id),
            'message' => 'Notification been deleted'
        ];
    }

    public function notify_new_possible_client($id, $cpf)
    {
        $notification = [
            'message' => 'Um novo cliente em potencial foi cadastrado atravez do app, o seu CPF é ' . ' ' . $cpf,
            'user_id' => $id,
        ];

        return $this->repository->create($notification);
    }

    public function send_user_and_password_to_client(array $data)
    {
        $data['message'] = 'Ola '
            . $data['name']
            . ', os seus dados de acesso no app bseg da Brasal Seguradora: Usuario: '
            . $data['email'] . ' Senha: Mudar123# ';
        $data['subject'] = 'Brasal Seguradora - Informaões de segurança no app bseg';
        //$this->smsService->store($data);
        $this->mailerService->create($data);
        return $this->repository->create($data);
    }

    public function notify_apolice_availability(array $data)
    {
        $data['message'] = 'Ola '
            . $data['name']
            . ', a sua apolice encontra-se disponivel no app bseg. 
            Se ainda não o tiver podes fazer o download em (android) https://goo.gl/eDyYFP
            e para iOS (iphone, ipad) https://goo.gl/f4YQmb';
        $data['subject'] = 'Brasal Seguradora - sua apolice já esta disponivel';
        //$this->smsService->store($data);
        $this->mailerService->create($data);
        return $this->repository->create($data);
    }
}