<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InsuranceTypeRepository;
use App\Entities\InsuranceType;
use App\Validators\InsuranceTypeValidator;

/**
 * Class InsuranceTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InsuranceTypeRepositoryEloquent extends BaseRepository implements InsuranceTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InsuranceType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InsuranceTypeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
