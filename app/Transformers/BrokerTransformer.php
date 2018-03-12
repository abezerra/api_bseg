<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Broker;

/**
 * Class BrokerTransformer.
 *
 * @package namespace App\Transformers;
 */
class BrokerTransformer extends TransformerAbstract
{
    /**
     * Transform the Broker entity.
     *
     * @param \App\Entities\Broker $model
     *
     * @return array
     */
    public function transform(Broker $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
