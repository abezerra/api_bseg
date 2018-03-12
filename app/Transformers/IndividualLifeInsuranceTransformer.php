<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\IndividualLifeInsurance;

/**
 * Class IndividualLifeInsuranceTransformer.
 *
 * @package namespace App\Transformers;
 */
class IndividualLifeInsuranceTransformer extends TransformerAbstract
{
    /**
     * Transform the IndividualLifeInsurance entity.
     *
     * @param \App\Entities\IndividualLifeInsurance $model
     *
     * @return array
     */
    public function transform(IndividualLifeInsurance $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
