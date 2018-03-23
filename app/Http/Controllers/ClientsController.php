<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Repositories\ClientRepository;
use App\Validators\ClientValidator;

/**
 * Class ClientsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ClientsController extends Controller
{
    /**
     * @var ClientService
     */
    private $service;

    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function client()
    {
        return $this->service->client();
    }

    public function lead()
    {
        return $this->service->lead();
    }

    public function store(Request $request)
    {
        return $this->service->store($request->all());
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
