<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Fiend;

/**
 * Class FiendTransformer.
 *
 * @package namespace App\Transformers;
 */
class FiendTransformer extends TransformerAbstract
{
    /**
     * Transform the Fiend entity.
     *
     * @param \App\Entities\Fiend $model
     *
     * @return array
     */
    public function transform(Fiend $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
