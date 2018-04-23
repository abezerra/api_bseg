<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Chats;

/**
 * Class ChatsTransformer.
 *
 * @package namespace App\Transformers;
 */
class ChatsTransformer extends TransformerAbstract
{
    /**
     * Transform the Chats entity.
     *
     * @param \App\Entities\Chats $model
     *
     * @return array
     */
    public function transform(Chats $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
