<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MailerListParticipantRepository;
use App\Entities\MailerListParticipant;
use App\Validators\MailerListParticipantValidator;

/**
 * Class MailerListParticipantRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MailerListParticipantRepositoryEloquent extends BaseRepository implements MailerListParticipantRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MailerListParticipant::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MailerListParticipantValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
