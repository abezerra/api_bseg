<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TemplatingRepository;
use App\Entities\Templating;
use App\Validators\TemplatingValidator;

/**
 * Class TemplatingRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TemplatingRepositoryEloquent extends BaseRepository implements TemplatingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Templating::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TemplatingValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
