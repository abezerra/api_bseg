<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 07/03/2018
 * Time: 14:48
 */

namespace App\Services;


use App\Repositories\MailerRepository;
use App\Validators\MailerValidator;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Mail;

class MailerService
{
    /**
     * @var MailerRepository
     */
    private $repository;
    /**
     * @var MailerValidator
     */
    private $validator;

    public function __construct(MailerRepository $repository, MailerValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        try {
            Mail::raw($data['message'], function ($message) use ($data) {
                $message->subject($data['subject']);
                $message->from('alsene@brasal.com.br', 'Alsene da Brasal Seguradora');
                $message->to($data['email']);
            });
            return $this->repository->create($data);
        } catch (ValidationException $exception) {
            return [
                'error' => true,
                'message' => $exception->getMessage()
            ];
        }
    }

    public function invite_fliendly(array $data)
    {
        try {
            Mail::send(('friendly'), ["data" => $data['name'], "friend" => $data['i']], function ($message) use ($data){
                $message->subject('Bem vindo á Brasal Corretora');
                $message->from('alsene@brasal.com.br', 'Alsene da Brasal Seguradora');
                $message->to($data['email']);
            });

            $data['sender'] = $data['i'];
            $data['to'] = $data['name'];
            return $this->repository->create($data);
        } catch (ValidationException $exception) {
            return [
                'error' => true,
                'message' => $exception->getMessage()
            ];
        }
    }
}