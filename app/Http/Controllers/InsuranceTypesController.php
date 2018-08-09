<?php

namespace App\Http\Controllers;

use App\Services\InsuranceTypeService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InsuranceTypeCreateRequest;
use App\Http\Requests\InsuranceTypeUpdateRequest;
use App\Repositories\InsuranceTypeRepository;
use App\Validators\InsuranceTypeValidator;

/**
 * Class InsuranceTypesController.
 *
 * @package namespace App\Http\Controllers;
 */
class InsuranceTypesController extends Controller
{

    /**
     * @var InsuranceTypeService
     */
    private $service;

    public function __construct(InsuranceTypeService $service)
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
    
    public function paginated()
    {
        return $this->service->paginated();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InsuranceTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        return $this->service->save($request->all());
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
        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InsuranceTypeUpdateRequest $request
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
