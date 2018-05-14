<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MailerTemplateRepository;
use App\Entities\MailerTemplate;
use App\Validators\MailerTemplateValidator;

/**
 * Class MailerTemplateRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MailerTemplateRepositoryEloquent extends BaseRepository implements MailerTemplateRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MailerTemplate::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MailerTemplateValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
