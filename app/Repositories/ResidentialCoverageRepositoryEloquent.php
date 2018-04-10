<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ResidentialCoverageRepository;
use App\Entities\ResidentialCoverage;
use App\Validators\ResidentialCoverageValidator;

/**
 * Class ResidentialCoverageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ResidentialCoverageRepositoryEloquent extends BaseRepository implements ResidentialCoverageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ResidentialCoverage::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ResidentialCoverageValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
