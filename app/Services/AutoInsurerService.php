<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 05/03/2018
 * Time: 11:45
 */

namespace App\Services;


use App\Entities\AutoInsurance;
use App\Repositories\AutoInsuranceRepository;
use App\Validators\AutoInsuranceValidator;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;

class AutoInsurerService
{
    /**
     * @var AutoInsuranceRepository
     */
    private $repository;
    /**
     * @var AutoInsuranceValidator
     */
    private $validator;
    /**
     * @var ClientService
     */
    private $clientService;
    /**
     * @var CoverageService
     */
    private $coverageService;
    /**
     * @var NotificationService
     */
    private $notificationService;

    public function __construct(AutoInsuranceRepository $repository,
                                AutoInsuranceValidator $validator,
                                ClientService $clientService,
                                CoverageService $coverageService,
                                NotificationService $notificationService)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->clientService = $clientService;
        $this->coverageService = $coverageService;
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        return $this->repository->with(['coverage', 'client'])->all();
    }

    public function store(array $data)
    {
        try
        {
            $is_client = $this->clientService->his_client($data['cpf'])->toArray();
            if (count($is_client) == 0) {
                $store_customer = $this->clientService->store_from_upload_policy($data)->toArray();
                $data['client_id'] = $store_customer['id'];
            } else {
                foreach ($is_client as $item) {
                    $existin_client_id_is = $item['id'];
                    $data['client_id'] = $existin_client_id_is;
                }
            }

            $save = $this->repository->create($data);

            for ($i = 0; $i < count($data['coverageArray']); ++$i) {
                $this->coverageService->store($data['coverageArray'][$i], $save['id']);
            }

            $this->notificationService->notify_apolice_availability($data);
            return [
                'code' => 200,
                'action' => $save,
                'message' => 'Auto Insurer has been created'
            ];
        }
        catch (ValidationException $exception)
        {
            return [
                'erro'=> 'Validation error',
                'code' => $exception->getCode(),
                'message'=> $exception->getMessage()
            ];
        }
    }

    public function show($id)
    {
        return $this->repository->with(['coverage', 'client'])->find($id);
    }

    public function update(array $data, $id)
    {
        try
        {
            $this->validator->with($data)->passesOrFail();
            return [
                'code' => 200,
                'action' => $this->repository->update($data, $id),
                'message' => 'Auto Insurer has been created'
            ];
        }
        catch (ValidationException $exception)
        {
            return [
                'erro'=> 'Validation error',
                'code' => $exception->getCode(),
                'message'=> $exception->getMessage()
            ];
        }
    }

    public function destroy($id)
    {
        return [
            'code' => '200',
            'action' => $this->repository->delete($id),
            'message' => 'Auto Insurer been deleted'
        ];
    }

    /**
     * @param $id
     * @return return auto insurance client searched of id
     */
    public function my_insurance($cpf)
    {
        return $this->repository->with(['client', 'coverage'])->findByField('cpf', $cpf);
    }

    public function is_active()
    {
        $today_is = Carbon::now();
        $start_monthly = Carbon::parse($today_is)->startOfMonth();
        $end_montly =  Carbon::parse($today_is)->endOfMonth();

        return DB::table('auto_insurances')
            ->whereNotBetween('validity', [$start_monthly, $end_montly])
            ->get()
            ->toArray();
    }

    public function auto_expired()
    {
        $today_is = Carbon::now();
        $start_monthly = Carbon::parse($today_is)->startOfMonth();

        $month = $start_monthly->month;
        if($start_monthly->month < 10)
        {
            $month = '0' .$start_monthly->month;
        }
        $day = $start_monthly->day;
        if($start_monthly->day < 10)
        {
            $day = '0' . $start_monthly->day;
        }

        $start_monthly = $start_monthly->year . '-' . $month . '-' . $day;

        return $this->repository->findWhere('validity', '>', $start_monthly);
    }

}