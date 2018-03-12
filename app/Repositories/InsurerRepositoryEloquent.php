<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InsurerRepository;
use App\Entities\Insurer;
use App\Validators\InsurerValidator;

/**
 * Class InsurerRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InsurerRepositoryEloquent extends BaseRepository implements InsurerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Insurer::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InsurerValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
