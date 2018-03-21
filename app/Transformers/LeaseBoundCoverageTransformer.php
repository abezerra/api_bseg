<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\LeaseBoundCoverage;

/**
 * Class LeaseBoundCoverageTransformer.
 *
 * @package namespace App\Transformers;
 */
class LeaseBoundCoverageTransformer extends TransformerAbstract
{
    /**
     * Transform the LeaseBoundCoverage entity.
     *
     * @param \App\Entities\LeaseBoundCoverage $model
     *
     * @return array
     */
    public function transform(LeaseBoundCoverage $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
