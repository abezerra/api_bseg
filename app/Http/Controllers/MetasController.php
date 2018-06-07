<?php

namespace App\Http\Controllers;

use App\Entities\Meta;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MetaCreateRequest;
use App\Http\Requests\MetaUpdateRequest;
use App\Repositories\MetaRepository;
use App\Validators\MetaValidator;

/**
 * Class MetasController.
 *
 * @package namespace App\Http\Controllers;
 */
class MetasController extends Controller
{
    /**
     * @var MetaRepository
     */
    protected $repository;

    /**
     * @var MetaValidator
     */
    protected $validator;
    /**
     * @var NotificationService
     */
    private $notificationService;

    /**
     * MetasController constructor.
     *
     * @param MetaRepository $repository
     * @param MetaValidator $validator
     */
    public function __construct(MetaRepository $repository, MetaValidator $validator,
                                NotificationService $notificationService)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->notificationService = $notificationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->repository->all(), 200);
    }

    public function paginated()
    {
        return response()->json($this->repository->with(['employer'])->paginate(5), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MetaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MetaCreateRequest $request)
    {
        $data = $request->all();
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $data['created_by'] = Auth::user()->id;
            $data['production_percentage'] = Auth::user()->id;
            $metum = $this->repository->create($data);
            //dd($this->notificationService->notify_employer_to_meta($data['employer_id']));
            $response = [
                'message' => 'Meta created.',
                'data' => $metum->toArray(),
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
        return response()->json($this->repository->find($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MetaUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public
    function update(MetaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $metum = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Meta updated.',
                'data' => $metum->toArray(),
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
            'message' => 'Meta deleted.',
            'deleted' => $deleted,
        ]);
    }

    public function mymeta($id)
    {
        $date = Carbon::now();

        $month = $date->month < 10 ? '0' . $date->month : $date->month;
        $day = $date->day < 10 ? '0' . $date->day : $date->day;
        $k = $day . '/' . $month . '/' . $date->year;

        $daily = Meta::with(['employer', 'user'])->where('employer_id', '=', $id)->where('day', '=', $k)->get()->toArray();

        return response()->json([
            'daily' => $daily,
            //'weekly' => $this->repository->with(['employer', 'user'])->findByField('employer_id', $id),
            'weekly' => $this->weekly_ranking()

        ]);
    }

    public function daily($id)
    {
        $date = Carbon::now();

        $month = $date->month < 10 ? '0' . $date->month : $date->month;
        $day = $date->day < 10 ? '0' . $date->day : $date->day;
        $k = $day . '/' . $month . '/' . $date->year;

        return (Meta::with(['employer', 'user'])->where('employer_id', '=', $id)->where('day', '=', $k)->get())->toArray();
    }

    public function weekly_ranking()
    {
        $start_week = Carbon::parse(Carbon::now())->startOfWeek();
        $start = ($start_week->day < 10 ? '0' . $start_week->day : $start_week->day) . '/'
            . ($start_week->month < 10 ? '0' . $start_week->month : $start_week->month)
            . '/' . $start_week->year;

        $end_week = Carbon::parse(Carbon::now())->endOfWeek();
        $end = (($end_week->day < 10 ? '0' . $end_week->day : $end_week->day) - 2) . '/'
            . ($end_week->month < 10 ? '0' . $end_week->month : $end_week->month)
            . '/' . $end_week->year;

        return (Meta::with(['employer', 'user'])->whereBetween('day', [$start, $end])->limit(5)->get())->toArray();


    }
}
