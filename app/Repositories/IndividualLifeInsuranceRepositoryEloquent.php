<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\IndividualLifeInsuranceRepository;
use App\Entities\IndividualLifeInsurance;
use App\Validators\IndividualLifeInsuranceValidator;

/**
 * Class IndividualLifeInsuranceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class IndividualLifeInsuranceRepositoryEloquent extends BaseRepository implements IndividualLifeInsuranceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return IndividualLifeInsurance::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return IndividualLifeInsuranceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
