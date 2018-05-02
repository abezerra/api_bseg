<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PushNotificationRepository;
use App\Entities\PushNotification;
use App\Validators\PushNotificationValidator;

/**
 * Class PushNotificationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PushNotificationRepositoryEloquent extends BaseRepository implements PushNotificationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PushNotification::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PushNotificationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
