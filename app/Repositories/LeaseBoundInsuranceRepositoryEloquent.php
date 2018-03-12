<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LeaseBoundInsuranceRepository;
use App\Entities\LeaseBoundInsurance;
use App\Validators\LeaseBoundInsuranceValidator;

/**
 * Class LeaseBoundInsuranceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LeaseBoundInsuranceRepositoryEloquent extends BaseRepository implements LeaseBoundInsuranceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LeaseBoundInsurance::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return LeaseBoundInsuranceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
