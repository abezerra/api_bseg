<?php

namespace App\Http\Controllers;

use App\Entities\MailerList;
use App\Repositories\MailerListRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MailerListParticipantCreateRequest;
use App\Http\Requests\MailerListParticipantUpdateRequest;
use App\Repositories\MailerListParticipantRepository;
use App\Validators\MailerListParticipantValidator;

/**
 * Class MailerListParticipantsController.
 *
 * @package namespace App\Http\Controllers;
 */
class MailerListParticipantsController extends Controller
{
    /**
     * @var MailerListParticipantRepository
     */
    protected $repository;

    /**
     * @var MailerListParticipantValidator
     */
    protected $validator;
    /**
     * @var MailerListRepository
     */
    private $mailerListRepository;

    /**
     * MailerListParticipantsController constructor.
     *
     * @param MailerListParticipantRepository $repository
     * @param MailerListParticipantValidator $validator
     */
    public function __construct(MailerListParticipantRepository $repository,
                                MailerListParticipantValidator $validator,
                                MailerListRepository $mailerListRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->mailerListRepository = $mailerListRepository;
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
        return $this->repository->with(['listy', 'client', 'users'])->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MailerListParticipantCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MailerListParticipantCreateRequest $request)
    {

        $data = $request->all();
        $data['created_by'] = \Auth::user()->id;
        try {

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $list = [];
            $list['name'] = $data['name'];
            $list['description'] = $data['description'];
            $list['created_by'] = $data['created_by'];

            $lista = $this->mailerListRepository->create($list);
            $data['mailer_lists_id'] = $lista['id'];

            for ($i = 0; $i < count($data['participants']); ++$i) {
                $p = $data['participants'][$i];
                $data['client_id'] = $p['id'];
                $mailerListParticipant = $this->repository->create($data);

            }


            $response = [
                'message' => 'MailerListParticipant created.',
                'data' => $mailerListParticipant->toArray(),
            ];

            return response()->json($response, 200);
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ], 500);
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
        $mailerListParticipant = $this->repository->with(['listy', 'client', 'users'])->find($id);
        return response()->json($mailerListParticipant, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MailerListParticipantUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MailerListParticipantUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $mailerListParticipant = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MailerListParticipant updated.',
                'data' => $mailerListParticipant->toArray(),
            ];
            return response()->json($response, 200);
        } catch (ValidatorException $e) {


            return response()->json([
                'error' => true,
                'message' => $e->getMessageBag()
            ], 500);
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
            'message' => 'MailerListParticipant deleted.',
            'deleted' => $deleted,
        ], 200);
    }
}
