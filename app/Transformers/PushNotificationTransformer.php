<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\PushNotification;

/**
 * Class PushNotificationTransformer.
 *
 * @package namespace App\Transformers;
 */
class PushNotificationTransformer extends TransformerAbstract
{
    /**
     * Transform the PushNotification entity.
     *
     * @param \App\Entities\PushNotification $model
     *
     * @return array
     */
    public function transform(PushNotification $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
