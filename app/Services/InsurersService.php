<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 07/03/2018
 * Time: 17:12
 */

namespace App\Services;


use App\Repositories\InsurerRepository;
use App\Validators\InsurerValidator;
use Dotenv\Exception\ValidationException;

class InsurersService
{
    /**
     * @var InsurerRepository
     */
    private $repository;
    /**
     * @var InsurerValidator
     */
    private $validator;

    public function __construct(InsurerRepository $repository, InsurerValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function index()
    {
        return $this->repository->all();
    }

    public function paginated()
    {
        return $this->repository->paginate(5);
    }

    public function store(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return [
                'code' => 200,
                'action' => $this->repository->create($data),
                'message' => 'Insurer has been created'
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
                'message' => 'Insurer has been created'
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
            'message' => 'Insurer been deleted'
        ];
    }
}