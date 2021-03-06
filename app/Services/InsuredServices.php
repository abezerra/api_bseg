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

    public function my_insurances($cpf)
    {
        return [
          'auto' => $this->autoInsurerService->my_insurance($cpf),
          'residential' => $this->residentialInsuranceService->my_insurance($cpf),
          'eo' => $this->EOInsuranceService->my_insurance($cpf),
          'life' => $this->individualInsuranceService->my_insurance($cpf),
          'lease' => $this->boundInsuranceService->my_insurance($cpf),
        ];
    }
}