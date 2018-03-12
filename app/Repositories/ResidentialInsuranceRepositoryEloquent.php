<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ResidentialInsuranceRepository;
use App\Entities\ResidentialInsurance;
use App\Validators\ResidentialInsuranceValidator;

/**
 * Class ResidentialInsuranceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ResidentialInsuranceRepositoryEloquent extends BaseRepository implements ResidentialInsuranceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ResidentialInsurance::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ResidentialInsuranceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
