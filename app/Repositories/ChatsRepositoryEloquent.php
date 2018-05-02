<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ChatsRepository;
use App\Entities\Chats;
use App\Validators\ChatsValidator;

/**
 * Class ChatsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ChatsRepositoryEloquent extends BaseRepository implements ChatsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chats::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ChatsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
