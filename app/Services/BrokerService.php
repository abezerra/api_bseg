<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 12/03/2018
 * Time: 17:50
 */

namespace App\Services;


use App\Entities\Broker;
use App\Repositories\BrokerRepository;
use App\Validators\BrokerValidator;

class BrokerService
{
    /**
     * @var BrokerRepository
     */
    private $repository;
    /**
     * @var BrokerValidator
     */
    private $validator;
    /**
     * @var DepartamentService
     */
    private $departamentService;

    public function __construct(BrokerRepository $repository, BrokerValidator $validator,
                                DepartamentService $departamentService)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->departamentService = $departamentService;
    }

    public function index()
    {
        return response()->json($this->repository->with(['departament'])->all());
    }

    public function store(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            $broker = $this->repository->create($data);

            for ($i = 0; $i < count($data['departamentArray']); $i++) {
                $this->departamentService->store($data['departamentArray'][$i], $broker['id']);
            }

            return response()->json(
                ['action' => $broker,
                    'message' => 'Borker has been created'
                ], 200
            );
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
                'message' => 'Borker has been created'
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
            'message' => 'Borker been deleted'
        ];
    }
}