<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MailerListParticipant;

/**
 * Class MailerListParticipantTransformer.
 *
 * @package namespace App\Transformers;
 */
class MailerListParticipantTransformer extends TransformerAbstract
{
    /**
     * Transform the MailerListParticipant entity.
     *
     * @param \App\Entities\MailerListParticipant $model
     *
     * @return array
     */
    public function transform(MailerListParticipant $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
