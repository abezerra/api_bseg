<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 15/03/2018
 * Time: 11:06
 */

namespace App\Services;


use App\Repositories\ResidentialCoverageRepository;
use App\Validators\ResidentialCoverageValidator;
use Dotenv\Exception\ValidationException;

class ResidentialCoverageService
{
    /**
     * @var ResidentialCoverageRepository
     */
    private $repository;
    /**
     * @var ResidentialCoverageValidator
     */
    private $validator;

    public function __construct(ResidentialCoverageRepository $repository,
                                ResidentialCoverageValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function index()
    {
        return $this->repository->with(['auto'])->all();
    }

    public function store(array $data, $id)
    {
        $data['insurer_id'] = $id;
        try
        {
            $this->validator->with($data)->passesOrFail();
            return [
                'code' => 200,
                'action' => $this->repository->create($data),
                'message' => 'Coverage has been created'
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
                'message' => 'Coverage has been created'
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
            'message' => 'Coverage has been deleted'
        ];
    }
}