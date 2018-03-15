<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LifeCoverageRepository;
use App\Entities\LifeCoverage;
use App\Validators\LifeCoverageValidator;

/**
 * Class LifeCoverageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LifeCoverageRepositoryEloquent extends BaseRepository implements LifeCoverageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LifeCoverage::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return LifeCoverageValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
