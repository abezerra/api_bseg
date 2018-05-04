<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 06/03/2018
 * Time: 14:03
 */

namespace App\Services;


use App\Repositories\AlertRepository;
use App\Validators\AlertValidator;

class AlertsService
{
    /**
     * @var AlertRepository
     */
    private $repository;
    /**
     * @var AlertValidator
     */
    private $validator;

    public function __construct(AlertRepository $repository, AlertValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function index()
    {
        return $this->repository->with(['user'])->all();
    }

    public function store(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return [
                'code' => 200,
                'action' => $this->repository->create($data),
                'message' => 'Auto Insurer has been created'
            ];
        } catch (ValidationException $exception) {
            return [
                'erro' => 'Validation error',
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];
        }
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return [
                'code' => 200,
                'action' => $this->repository->update($data, $id),
                'message' => 'Auto Insurer has been created'
            ];
        } catch (ValidationException $exception) {
            return [
                'erro' => 'Validation error',
                'code' => $exception->getCode(),
                'message' => $exception->getMessage()
            ];
        }
    }

    public function destroy($id)
    {
        return [
            'code' => '200',
            'action' => $this->repository->delete($id),
            'message' => 'Auto Insurer been deleted'
        ];
    }
}