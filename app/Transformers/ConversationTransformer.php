<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Conversation;

/**
 * Class ConversationTransformer.
 *
 * @package namespace App\Transformers;
 */
class ConversationTransformer extends TransformerAbstract
{
    /**
     * Transform the Conversation entity.
     *
     * @param \App\Entities\Conversation $model
     *
     * @return array
     */
    public function transform(Conversation $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
