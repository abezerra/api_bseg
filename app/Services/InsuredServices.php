<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 15/03/2018
 * Time: 09:43
 */

namespace App\Services;


class InsuredServices
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
     * @var ResidentialInsuranceService
     */
    private $residentialInsuranceService;
    /**
     * @var LeaseBoundInsuranceService
     */
    private $boundInsuranceService;

    public function __construct(AutoInsurerService $autoInsurerService,
                                EOInsuranceService $EOInsuranceService,
                                IndividualInsuranceService $individualInsuranceService,
                                ResidentialInsuranceService $residentialInsuranceService,
                                LeaseBoundInsuranceService $boundInsuranceService)
    {
        $this->autoInsurerService = $autoInsurerService;
        $this->EOInsuranceService = $EOInsuranceService;
        $this->individualInsuranceService = $individualInsuranceService;
        $this->residentialInsuranceService = $residentialInsuranceService;
        $this->boundInsuranceService = $boundInsuranceService;
    }

    public function my_insurances($id)
    {
        return [
          'auto' => $this->autoInsurerService->my_insurance($id),
          'residential' => $this->residentialInsuranceService->my_insurance($id),
          'eo' => $this->EOInsuranceService->my_insurance($id),
          'life' => $this->individualInsuranceService->my_insurance($id),
          'lease' => $this->boundInsuranceService->my_insurance($id),
        ];
    }
}