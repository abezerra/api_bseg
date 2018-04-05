<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DefaultsTemplatingRepository;
use App\Entities\DefaultsTemplating;
use App\Validators\DefaultsTemplatingValidator;

/**
 * Class DefaultsTemplatingRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DefaultsTemplatingRepositoryEloquent extends BaseRepository implements DefaultsTemplatingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DefaultsTemplating::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DefaultsTemplatingValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
