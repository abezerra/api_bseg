<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\DefaultsTemplating;

/**
 * Class DefaultsTemplatingTransformer.
 *
 * @package namespace App\Transformers;
 */
class DefaultsTemplatingTransformer extends TransformerAbstract
{
    /**
     * Transform the DefaultsTemplating entity.
     *
     * @param \App\Entities\DefaultsTemplating $model
     *
     * @return array
     */
    public function transform(DefaultsTemplating $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
