<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AutoInsuranceRepository;
use App\Entities\AutoInsurance;
use App\Validators\AutoInsuranceValidator;

/**
 * Class AutoInsuranceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AutoInsuranceRepositoryEloquent extends BaseRepository implements AutoInsuranceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AutoInsurance::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AutoInsuranceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
