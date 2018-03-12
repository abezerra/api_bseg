<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 05/03/2018
 * Time: 11:49
 */

namespace App\Services;


use App\Repositories\EmployerRepository;
use App\Validators\EmployerValidator;

class EmployerService
{
    /**
     * @var EmployerRepository
     */
    private $repository;
    /**
     * @var EmployerValidator
     */
    private $validator;

    public function __construct(EmployerRepository $repository, EmployerValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
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
                'message' => 'Employer has been created'
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

    public function update(array $data, $id)
    {
        try
        {
            $this->validator->with($data)->passesOrFail();
            return [
                'code' => 200,
                'action' => $this->repository->update($data, $id),
                'message' => 'Employer has been created'
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
            'message' => 'Employer been deleted'
        ];
    }
}