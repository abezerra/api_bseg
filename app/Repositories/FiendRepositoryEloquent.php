<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FiendRepository;
use App\Entities\Fiend;
use App\Validators\FiendValidator;

/**
 * Class FiendRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FiendRepositoryEloquent extends BaseRepository implements FiendRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Fiend::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FiendValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
