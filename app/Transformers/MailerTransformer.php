<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Mailer;

/**
 * Class MailerTransformer.
 *
 * @package namespace App\Transformers;
 */
class MailerTransformer extends TransformerAbstract
{
    /**
     * Transform the Mailer entity.
     *
     * @param \App\Entities\Mailer $model
     *
     * @return array
     */
    public function transform(Mailer $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
