<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SMSTemplateCreateRequest;
use App\Http\Requests\SMSTemplateUpdateRequest;
use App\Repositories\SMSTemplateRepository;
use App\Validators\SMSTemplateValidator;
use App\Entities\SMSTemplate;

/**
 * Class SMSTemplatesController.
 *
 * @package namespace App\Http\Controllers;
 */
class SMSTemplatesController extends Controller
{
    /**
     * @var SMSTemplateRepository
     */
    protected $repository;

    /**
     * @var SMSTemplateValidator
     */
    protected $validator;

    /**
     * SMSTemplatesController constructor.
     *
     * @param SMSTemplateRepository $repository
     * @param SMSTemplateValidator $validator
     */
    public function __construct(SMSTemplateRepository $repository, SMSTemplateValidator $validator)
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

    public function paginated()
    {
        return $this->repository->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SMSTemplateCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SMSTemplateCreateRequest $request)
    {
        $data = $request->all();
        try {

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);


            $sMSTemplate = SMSTemplate::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'content' => $data['content'],
                'created_by' => \Auth::user()->id,
            ]);

            $response = [
                'message' => 'SMSTemplate created.',
                'data' => $sMSTemplate->toArray(),
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
     * @param  SMSTemplateUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SMSTemplateUpdateRequest $request, $id)
    {
        $data = $request->all();
        $data['created_by'] = \Auth::user()->id;
        try {

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $sMSTemplate = $this->repository->update($data, $id);

            $response = [
                'message' => 'SMSTemplate updated.',
                'data' => $sMSTemplate->toArray(),
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
            'message' => 'SMSTemplate deleted.',
            'deleted' => $deleted,
        ]);

    }
}
