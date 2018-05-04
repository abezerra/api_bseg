<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 26/03/2018
 * Time: 10:10
 */

namespace App\Services;


use App\Repositories\FiendRepository;
use App\Validators\FiendValidator;
use Dotenv\Exception\ValidationException;

class FriendlyInvite
{
    /**
     * @var FiendRepository
     */
    private $repository;
    /**
     * @var FiendValidator
     */
    private $validator;
    /**
     * @var NotificationService
     */
    private $notificationService;

    public function __construct(FiendRepository $repository,
                                FiendValidator $validator,
                                NotificationService $notificationService)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function store(array $data)
    {
        try
        {
            $action = $this->repository->create($data);
            $this->notificationService->notify_invitation_friendly($data);
            return [
                'code' => 200,
                'action' => $action,
                'message' => 'Invite has been created'
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

}