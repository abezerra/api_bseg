<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ResidentialInsurance;

/**
 * Class ResidentialInsuranceTransformer.
 *
 * @package namespace App\Transformers;
 */
class ResidentialInsuranceTransformer extends TransformerAbstract
{
    /**
     * Transform the ResidentialInsurance entity.
     *
     * @param \App\Entities\ResidentialInsurance $model
     *
     * @return array
     */
    public function transform(ResidentialInsurance $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
