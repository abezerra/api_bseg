<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 07/03/2018
 * Time: 13:29
 */

namespace App\Services;

use App\Repositories\SmsRepository;
use Nexmo\Laravel\Facade\Nexmo;

class SmsService
{
    /**
     * @var SmsRepository
     */
    private $repository;

    public function __construct(SmsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {

    }

    public function store(array $data)
    {
        Nexmo::message()->send([
            'to' => $data['to'],
            'from' => $data['from'],
            'text' => $data['message']
        ]);
        return $this->repository->create($data);
    }
}