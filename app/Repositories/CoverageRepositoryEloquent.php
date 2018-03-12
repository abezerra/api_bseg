<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CoverageRepository;
use App\Entities\Coverage;
use App\Validators\CoverageValidator;

/**
 * Class CoverageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CoverageRepositoryEloquent extends BaseRepository implements CoverageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Coverage::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CoverageValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
