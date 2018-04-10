<?php

namespace App\Http\Controllers;

use App\Services\LeaseBoundCoveragesService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\LeaseBoundCoverageCreateRequest;
use App\Http\Requests\LeaseBoundCoverageUpdateRequest;
use App\Repositories\LeaseBoundCoverageRepository;
use App\Validators\LeaseBoundCoverageValidator;

/**
 * Class LeaseBoundCoveragesController.
 *
 * @package namespace App\Http\Controllers;
 */
class LeaseBoundCoveragesController extends Controller
{

    /**
     * @var LeaseBoundCoveragesService
     */
    private $service;

    public function __construct(LeaseBoundCoveragesService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->service->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LeaseBoundCoverageCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        return $this->service->store($request->all());
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
        return $this->service->show($d);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LeaseBoundCoverageUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
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
        return $this->service->destroy($id);
    }
}
