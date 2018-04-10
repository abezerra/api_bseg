<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EOCoverageRepository;
use App\Entities\EOCoverage;
use App\Validators\EOCoverageValidator;

/**
 * Class EOCoverageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EOCoverageRepositoryEloquent extends BaseRepository implements EOCoverageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EOCoverage::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EOCoverageValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
