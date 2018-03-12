<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EOInsuranceRepository;
use App\Entities\EOInsurance;
use App\Validators\EOInsuranceValidator;

/**
 * Class EOInsuranceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EOInsuranceRepositoryEloquent extends BaseRepository implements EOInsuranceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EOInsurance::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EOInsuranceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
