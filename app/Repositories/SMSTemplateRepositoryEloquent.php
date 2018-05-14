<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SMSTemplateRepository;
use App\Entities\SMSTemplate;
use App\Validators\SMSTemplateValidator;

/**
 * Class SMSTemplateRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SMSTemplateRepositoryEloquent extends BaseRepository implements SMSTemplateRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SMSTemplate::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SMSTemplateValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
