<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Meta;

/**
 * Class MetaTransformer.
 *
 * @package namespace App\Transformers;
 */
class MetaTransformer extends TransformerAbstract
{
    /**
     * Transform the Meta entity.
     *
     * @param \App\Entities\Meta $model
     *
     * @return array
     */
    public function transform(Meta $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
