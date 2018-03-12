<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\LeaseBoundInsurance;

/**
 * Class LeaseBoundInsuranceTransformer.
 *
 * @package namespace App\Transformers;
 */
class LeaseBoundInsuranceTransformer extends TransformerAbstract
{
    /**
     * Transform the LeaseBoundInsurance entity.
     *
     * @param \App\Entities\LeaseBoundInsurance $model
     *
     * @return array
     */
    public function transform(LeaseBoundInsurance $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
