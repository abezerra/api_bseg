<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\LifeCoverage;

/**
 * Class LifeCoverageTransformer.
 *
 * @package namespace App\Transformers;
 */
class LifeCoverageTransformer extends TransformerAbstract
{
    /**
     * Transform the LifeCoverage entity.
     *
     * @param \App\Entities\LifeCoverage $model
     *
     * @return array
     */
    public function transform(LifeCoverage $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
