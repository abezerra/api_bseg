<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SMSListRepository;
use App\Entities\SMSList;
use App\Validators\SMSListValidator;

/**
 * Class SMSListRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SMSListRepositoryEloquent extends BaseRepository implements SMSListRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SMSList::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SMSListValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
