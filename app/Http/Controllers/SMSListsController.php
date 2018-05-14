<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SMSListCreateRequest;
use App\Http\Requests\SMSListUpdateRequest;
use App\Repositories\SMSListRepository;
use App\Validators\SMSListValidator;

/**
 * Class SMSListsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SMSListsController extends Controller
{
    /**
     * @var SMSListRepository
     */
    protected $repository;

    /**
     * @var SMSListValidator
     */
    protected $validator;

    /**
     * SMSListsController constructor.
     *
     * @param SMSListRepository $repository
     * @param SMSListValidator $validator
     */
    public function __construct(SMSListRepository $repository, SMSListValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
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

    public function pagianted()
    {
        return $this->repository->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SMSListCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SMSListCreateRequest $request)
    {
        $data = $request->all();
        $data['created_by'] = \Auth::user()->id;
        try {

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $sMSList = $this->repository->create($data);

            $response = [
                'message' => 'SMSList created.',
                'data' => $sMSList->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);
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
     * @param  SMSListUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SMSListUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $sMSList = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SMSList updated.',
                'data' => $sMSList->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {

            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ]);
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
        $deleted = $this->repository->delete($id);

        return response()->json([
            'message' => 'SMSList deleted.',
            'deleted' => $deleted,
        ]);

    }
}
