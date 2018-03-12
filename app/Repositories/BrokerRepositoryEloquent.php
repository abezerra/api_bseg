<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BrokerRepository;
use App\Entities\Broker;
use App\Validators\BrokerValidator;

/**
 * Class BrokerRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BrokerRepositoryEloquent extends BaseRepository implements BrokerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Broker::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BrokerValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
