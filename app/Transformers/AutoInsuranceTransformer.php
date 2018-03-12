<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\AutoInsurance;

/**
 * Class AutoInsuranceTransformer.
 *
 * @package namespace App\Transformers;
 */
class AutoInsuranceTransformer extends TransformerAbstract
{
    /**
     * Transform the AutoInsurance entity.
     *
     * @param \App\Entities\AutoInsurance $model
     *
     * @return array
     */
    public function transform(AutoInsurance $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
