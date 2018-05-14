<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\SMSTemplate;

/**
 * Class SMSTemplateTransformer.
 *
 * @package namespace App\Transformers;
 */
class SMSTemplateTransformer extends TransformerAbstract
{
    /**
     * Transform the SMSTemplate entity.
     *
     * @param \App\Entities\SMSTemplate $model
     *
     * @return array
     */
    public function transform(SMSTemplate $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
