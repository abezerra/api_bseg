<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MessageReply;

/**
 * Class MessageReplyTransformer.
 *
 * @package namespace App\Transformers;
 */
class MessageReplyTransformer extends TransformerAbstract
{
    /**
     * Transform the MessageReply entity.
     *
     * @param \App\Entities\MessageReply $model
     *
     * @return array
     */
    public function transform(MessageReply $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
