<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MailerListCreateRequest;
use App\Http\Requests\MailerListUpdateRequest;
use App\Repositories\MailerListRepository;
use App\Validators\MailerListValidator;

/**
 * Class MailerListsController.
 *
 * @package namespace App\Http\Controllers;
 */
class MailerListsController extends Controller
{
    /**
     * @var MailerListRepository
     */
    protected $repository;

    /**
     * @var MailerListValidator
     */
    protected $validator;

    /**
     * MailerListsController constructor.
     *
     * @param MailerListRepository $repository
     * @param MailerListValidator $validator
     */
    public function __construct(MailerListRepository $repository, MailerListValidator $validator)
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
        return $this->repository->with(['user', 'participants', 'client'])->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MailerListCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MailerListCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $mailerList = $this->repository->create($request->all());

            $response = [
                'message' => 'MailerList created.',
                'data' => $mailerList->toArray(),
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
        return $this->repository->with(['user', 'participants', 'client'])->find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  MailerListUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MailerListUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $mailerList = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MailerList updated.',
                'data' => $mailerList->toArray(),
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
            'message' => 'MailerList deleted.',
            'deleted' => $deleted,
        ]);

    }
}
