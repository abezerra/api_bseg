<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 05/04/2018
 * Time: 11:46
 */

namespace App\Http\Controllers;


use App\Services\AutoInsurerService;
use App\Services\EOInsuranceService;
use App\Services\IndividualInsuranceService;
use App\Services\LeaseBoundInsuranceService;
use App\Services\ResidentialInsuranceService;
use Carbon\Carbon;
use DB;

class DashboardController
{
    /**
     * @var AutoInsurerService
     */
    private $autoInsurerService;
    /**
     * @var EOInsuranceService
     */
    private $EOInsuranceService;
    /**
     * @var IndividualInsuranceService
     */
    private $individualInsuranceService;
    /**
     * @var LeaseBoundInsuranceService
     */
    private $leaseBoundInsuranceService;
    /**
     * @var ResidentialInsuranceService
     */
    private $residentialInsuranceService;

    public function __construct(AutoInsurerService $autoInsurerService,
                                EOInsuranceService $EOInsuranceService,
                                IndividualInsuranceService $individualInsuranceService,
                                LeaseBoundInsuranceService $leaseBoundInsuranceService,
                                ResidentialInsuranceService $residentialInsuranceService)
    {
        $this->autoInsurerService = $autoInsurerService;
        $this->EOInsuranceService = $EOInsuranceService;
        $this->individualInsuranceService = $individualInsuranceService;
        $this->leaseBoundInsuranceService = $leaseBoundInsuranceService;
        $this->residentialInsuranceService = $residentialInsuranceService;
    }

    public function all_insurances_of_dashboard()
    {
        return [
            'auto' => $this->autoInsurerService->index(),
            'eo' => $this->EOInsuranceService->index(),
            'life' => $this->individualInsuranceService->index(),
            'lease' => $this->leaseBoundInsuranceService->index(),
            'residential' => $this->residentialInsuranceService->index(),
        ];
    }


    public function is_active()
    {
        return [
            'auto' => $this->autoInsurerService->is_active()
        ];
    }

    public function renew_over_the_next_thirty_days()
    {
        // a solução ta porcona mas foi a que a cabeça quente conseguiu fazer na hora
        // melhoras no code review

        $today_is = Carbon::now();
        $start_monthly = Carbon::parse($today_is)->startOfMonth();
        $end_montly = Carbon::parse($today_is)->endOfMonth();

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
        $end_montly = $end_montly->year . '-' . $month . '-' . $end_montly->day;

        $auto = DB::table('auto_insurances')
            ->whereBetween('validity', [$start_monthly, $end_montly])
            ->get()
            ->toArray();

        $eo = DB::table('e_o_insurances')
            ->whereBetween('validity', [$start_monthly, $end_montly])
            ->get()
            ->toArray();

        $lease = DB::table('lease_bound_insurances')
            ->whereBetween('validity', [$start_monthly, $end_montly])
            ->get()
            ->toArray();

        $life = DB::table('individual_life_insurances')
            ->whereBetween('validity', [$start_monthly, $end_montly])
            ->get()
            ->toArray();

        $residential = DB::table('residential_insurances')
            ->whereBetween('validity', [$start_monthly, $end_montly])
            ->get()
            ->toArray();

        $auto = count($auto);
        $eo = count($eo);
        $lease = count($lease);
        $life = count($life);
        $residential = count($residential);


        //verify if insurance has expired

        $auto_is_expired = DB::table('auto_insurances')
            ->where('validity', '>', $start_monthly)
            ->get()
            ->toArray();

        $eo_is_expired = DB::table('e_o_insurances')
            ->where('validity', '>', $start_monthly)
            ->get()
            ->toArray();

        $lease_is_expired = DB::table('lease_bound_insurances')
            ->where('validity', '>', $start_monthly)
            ->get()
            ->toArray();

        $life_is_expired = DB::table('individual_life_insurances')
            ->where('validity', '>', $start_monthly)
            ->get()
            ->toArray();

        $residential_is_expired = DB::table('residential_insurances')
            ->where('validity', '>', $start_monthly)
            ->get()
            ->toArray();

        $auto_is_expired= count($auto_is_expired);
        $eo_is_expired= count($eo_is_expired);
        $lease_is_expired= count($lease_is_expired);
        $life_is_expired= count($life_is_expired);
        $residential_is_expired= count($residential_is_expired);


        return [
            'renew' => ($auto + $lease + $life + $eo + $residential),
            'insurances_expired' => ($auto_is_expired + $eo_is_expired + $lease_is_expired + $life_is_expired + $residential_is_expired),
        ];

    }

    public function total_hired()
    {
        //total hired
        $all_auto = count($this->autoInsurerService->index());
        $all_eo = count($this->EOInsuranceService->index());
        $all_life = count($this->individualInsuranceService->index());
        $all_lease = count($this->leaseBoundInsuranceService->index());
        $all_residential = count($this->residentialInsuranceService->index());

        return [
            'total_insurances_registered' => ($all_auto + $all_eo + $all_lease + $all_life + $all_residential),
            'auto' => $all_auto,
            'eo' => $all_eo,
            'life' => $all_life,
            'lease' => $all_lease,
            'residential' => $all_residential
        ];
    }

}