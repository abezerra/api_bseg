<?php

namespace App\Http\Controllers;

use App\Services\UsersService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

/**
 * Class AutoInsurancesController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{

    /**
     * @var UsersService
     */
    private $service;

    public function __construct(UsersService $service)
    {

        $this->service = $service;
    }

    public function index()
    {
        return DB::table('users')->get();
    }

    public function create_new(Request $request)
    {
        return $this->service->create_new_with_policy($request->all());
    }

}
