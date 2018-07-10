<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DefaultsTemplatingCreateRequest;
use App\Http\Requests\DefaultsTemplatingUpdateRequest;
use App\Repositories\DefaultsTemplatingRepository;
use App\Validators\DefaultsTemplatingValidator;

/**
 * Class DefaultsTemplatingsController.
 *
 * @package namespace App\Http\Controllers;
 */
class DefaultsTemplatingsController extends Controller
{
    /**
     * @var DefaultsTemplatingRepository
     */
    protected $repository;

    /**
     * @var DefaultsTemplatingValidator
     */
    protected $validator;

    /**
     * DefaultsTemplatingsController constructor.
     *
     * @param DefaultsTemplatingRepository $repository
     * @param DefaultsTemplatingValidator $validator
     */
    public function __construct(DefaultsTemplatingRepository $repository, DefaultsTemplatingValidator $validator)
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  DefaultsTemplatingCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        try {

            $data = $request->all();
            //dd(request()->image->getClientOriginalExtension());

            //$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $file_name = md5(time()) . '.' . request()->image->getClientOriginalExtension();

            request()->image->move(public_path('images'), $file_name);


            $data['media_name'] = $file_name;
            $data['media_url'] =   env('APP_URL') . '/images'  . '/'. $file_name;
            $data['status'] = 'active';
            $data['created_by'] = \Auth::user()->id;

            $defaultsTemplating = $this->repository->create($data);

            $response = [
                'message' => 'DefaultsTemplating created.',
                'data' => $defaultsTemplating->toArray(),
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
     * @param  DefaultsTemplatingUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id)
    {
        try {


            $data['status'] = 'disabled';
            $defaultsTemplating = $this->repository->update($data, $id);
            return response()->json([
                'message' => 'DefaultsTemplating disabled',
                'data' => $defaultsTemplating->toArray(),
            ]);

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
            'message' => 'DefaultsTemplating deleted.',
            'deleted' => $deleted,
        ]);
    }
}
