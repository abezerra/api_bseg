<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\SMSList;

/**
 * Class SMSListTransformer.
 *
 * @package namespace App\Transformers;
 */
class SMSListTransformer extends TransformerAbstract
{
    /**
     * Transform the SMSList entity.
     *
     * @param \App\Entities\SMSList $model
     *
     * @return array
     */
    public function transform(SMSList $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
