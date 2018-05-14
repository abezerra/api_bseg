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
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $sMSTemplates = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sMSTemplates,
            ]);
        }

        return view('sMSTemplates.index', compact('sMSTemplates'));
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
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $sMSTemplate = $this->repository->create($request->all());

            $response = [
                'message' => 'SMSTemplate created.',
                'data'    => $sMSTemplate->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
        $sMSTemplate = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sMSTemplate,
            ]);
        }

        return view('sMSTemplates.show', compact('sMSTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sMSTemplate = $this->repository->find($id);

        return view('sMSTemplates.edit', compact('sMSTemplate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SMSTemplateUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SMSTemplateUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $sMSTemplate = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SMSTemplate updated.',
                'data'    => $sMSTemplate->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'SMSTemplate deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'SMSTemplate deleted.');
    }
}
