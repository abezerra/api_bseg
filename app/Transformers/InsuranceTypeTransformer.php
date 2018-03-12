<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\InsuranceType;

/**
 * Class InsuranceTypeTransformer.
 *
 * @package namespace App\Transformers;
 */
class InsuranceTypeTransformer extends TransformerAbstract
{
    /**
     * Transform the InsuranceType entity.
     *
     * @param \App\Entities\InsuranceType $model
     *
     * @return array
     */
    public function transform(InsuranceType $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
