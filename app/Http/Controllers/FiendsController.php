<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\FiendCreateRequest;
use App\Http\Requests\FiendUpdateRequest;
use App\Repositories\FiendRepository;
use App\Validators\FiendValidator;

/**
 * Class FiendsController.
 *
 * @package namespace App\Http\Controllers;
 */
class FiendsController extends Controller
{
    /**
     * @var FiendRepository
     */
    protected $repository;

    /**
     * @var FiendValidator
     */
    protected $validator;

    /**
     * FiendsController constructor.
     *
     * @param FiendRepository $repository
     * @param FiendValidator $validator
     */
    public function __construct(FiendRepository $repository, FiendValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FiendCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail();
            return [
                'code' => 200,
                'action' => $this->repository->create($request->all()),
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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FiendUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail();
            return [
                'code' => 200,
                'action' => $this->repository->update($request->all(), $id),
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return [
            'code' => '200',
            'action' => $this->repository->delete($id),
            'message' => 'Auto Insurer been deleted'
        ];
    }
}
