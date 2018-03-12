<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Policy;

/**
 * Class PolicyTransformer.
 *
 * @package namespace App\Transformers;
 */
class PolicyTransformer extends TransformerAbstract
{
    /**
     * Transform the Policy entity.
     *
     * @param \App\Entities\Policy $model
     *
     * @return array
     */
    public function transform(Policy $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
