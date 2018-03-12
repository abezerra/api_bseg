<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\EOInsurance;

/**
 * Class EOInsuranceTransformer.
 *
 * @package namespace App\Transformers;
 */
class EOInsuranceTransformer extends TransformerAbstract
{
    /**
     * Transform the EOInsurance entity.
     *
     * @param \App\Entities\EOInsurance $model
     *
     * @return array
     */
    public function transform(EOInsurance $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
