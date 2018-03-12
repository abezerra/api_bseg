<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Coverage;

/**
 * Class CoverageTransformer.
 *
 * @package namespace App\Transformers;
 */
class CoverageTransformer extends TransformerAbstract
{
    /**
     * Transform the Coverage entity.
     *
     * @param \App\Entities\Coverage $model
     *
     * @return array
     */
    public function transform(Coverage $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
