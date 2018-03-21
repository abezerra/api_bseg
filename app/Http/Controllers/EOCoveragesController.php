<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EOCoverageCreateRequest;
use App\Http\Requests\EOCoverageUpdateRequest;
use App\Repositories\EOCoverageRepository;
use App\Validators\EOCoverageValidator;

/**
 * Class EOCoveragesController.
 *
 * @package namespace App\Http\Controllers;
 */
class EOCoveragesController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $eOCoverages = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $eOCoverages,
            ]);
        }

        return view('eOCoverages.index', compact('eOCoverages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EOCoverageCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EOCoverageCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $eOCoverage = $this->repository->create($request->all());

            $response = [
                'message' => 'EOCoverage created.',
                'data'    => $eOCoverage->toArray(),
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
        $eOCoverage = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $eOCoverage,
            ]);
        }

        return view('eOCoverages.show', compact('eOCoverage'));
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
        $eOCoverage = $this->repository->find($id);

        return view('eOCoverages.edit', compact('eOCoverage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EOCoverageUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EOCoverageUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $eOCoverage = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'EOCoverage updated.',
                'data'    => $eOCoverage->toArray(),
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
                'message' => 'EOCoverage deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'EOCoverage deleted.');
    }
}
