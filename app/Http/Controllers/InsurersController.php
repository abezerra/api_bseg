<?php

namespace App\Http\Controllers;

use App\Services\InsurersService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InsurerCreateRequest;
use App\Http\Requests\InsurerUpdateRequest;
use App\Repositories\InsurerRepository;
use App\Validators\InsurerValidator;
use Pusher\Pusher;

/**
 * Class InsurersController.
 *
 * @package namespace App\Http\Controllers;
 */
class InsurersController extends Controller
{

    /**
     * @var InsurersService
     */
    private $service;

    public function __construct(InsurersService $service)
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
     * @param  InsurerCreateRequest $request
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
        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InsurerUpdateRequest $request
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

    public function send_push()
    {
        $options = array(
            'cluster' => 'us2',
            'encrypted' => true
        );
        $pusher = new Pusher(
            'b1c9dfd0226ff506116d',
            'b5489d77641c1e4d77fb',
            '491393',
            $options
        );
        $data['message'] = 'hail farofa';
        return $pusher->trigger('my-channel', 'event', $data);
    }
}
