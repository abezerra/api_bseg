<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MailerList;

/**
 * Class MailerListTransformer.
 *
 * @package namespace App\Transformers;
 */
class MailerListTransformer extends TransformerAbstract
{
    /**
     * Transform the MailerList entity.
     *
     * @param \App\Entities\MailerList $model
     *
     * @return array
     */
    public function transform(MailerList $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
