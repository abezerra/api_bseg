<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MailerListRepository;
use App\Entities\MailerList;
use App\Validators\MailerListValidator;

/**
 * Class MailerListRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MailerListRepositoryEloquent extends BaseRepository implements MailerListRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MailerList::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MailerListValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
