<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MailerTemplate;

/**
 * Class MailerTemplateTransformer.
 *
 * @package namespace App\Transformers;
 */
class MailerTemplateTransformer extends TransformerAbstract
{
    /**
     * Transform the MailerTemplate entity.
     *
     * @param \App\Entities\MailerTemplate $model
     *
     * @return array
     */
    public function transform(MailerTemplate $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
