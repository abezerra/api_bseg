<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Employer;

/**
 * Class EmployerTransformer.
 *
 * @package namespace App\Transformers;
 */
class EmployerTransformer extends TransformerAbstract
{
    /**
     * Transform the Employer entity.
     *
     * @param \App\Entities\Employer $model
     *
     * @return array
     */
    public function transform(Employer $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
