<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LeaseBoundCoverageRepository;
use App\Entities\LeaseBoundCoverage;
use App\Validators\LeaseBoundCoverageValidator;

/**
 * Class LeaseBoundCoverageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LeaseBoundCoverageRepositoryEloquent extends BaseRepository implements LeaseBoundCoverageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LeaseBoundCoverage::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return LeaseBoundCoverageValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
