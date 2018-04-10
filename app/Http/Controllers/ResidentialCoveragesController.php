<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ResidentialCoverageCreateRequest;
use App\Http\Requests\ResidentialCoverageUpdateRequest;
use App\Repositories\ResidentialCoverageRepository;
use App\Validators\ResidentialCoverageValidator;

/**
 * Class ResidentialCoveragesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ResidentialCoveragesController extends Controller
{
    /**
     * @var ResidentialCoverageRepository
     */
    protected $repository;

    /**
     * @var ResidentialCoverageValidator
     */
    protected $validator;

    /**
     * ResidentialCoveragesController constructor.
     *
     * @param ResidentialCoverageRepository $repository
     * @param ResidentialCoverageValidator $validator
     */
    public function __construct(ResidentialCoverageRepository $repository, ResidentialCoverageValidator $validator)
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
        $residentialCoverages = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $residentialCoverages,
            ]);
        }

        return view('residentialCoverages.index', compact('residentialCoverages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ResidentialCoverageCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ResidentialCoverageCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $residentialCoverage = $this->repository->create($request->all());

            $response = [
                'message' => 'ResidentialCoverage created.',
                'data'    => $residentialCoverage->toArray(),
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
        $residentialCoverage = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $residentialCoverage,
            ]);
        }

        return view('residentialCoverages.show', compact('residentialCoverage'));
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
        $residentialCoverage = $this->repository->find($id);

        return view('residentialCoverages.edit', compact('residentialCoverage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ResidentialCoverageUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ResidentialCoverageUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $residentialCoverage = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ResidentialCoverage updated.',
                'data'    => $residentialCoverage->toArray(),
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
                'message' => 'ResidentialCoverage deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ResidentialCoverage deleted.');
    }
}
