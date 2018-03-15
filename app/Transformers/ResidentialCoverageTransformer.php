<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ResidentialCoverage;

/**
 * Class ResidentialCoverageTransformer.
 *
 * @package namespace App\Transformers;
 */
class ResidentialCoverageTransformer extends TransformerAbstract
{
    /**
     * Transform the ResidentialCoverage entity.
     *
     * @param \App\Entities\ResidentialCoverage $model
     *
     * @return array
     */
    public function transform(ResidentialCoverage $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
