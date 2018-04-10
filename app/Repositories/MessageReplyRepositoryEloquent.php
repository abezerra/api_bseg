<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MessageReplyRepository;
use App\Entities\MessageReply;
use App\Validators\MessageReplyValidator;

/**
 * Class MessageReplyRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MessageReplyRepositoryEloquent extends BaseRepository implements MessageReplyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MessageReply::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MessageReplyValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
