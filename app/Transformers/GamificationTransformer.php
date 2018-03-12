<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Gamification;

/**
 * Class GamificationTransformer.
 *
 * @package namespace App\Transformers;
 */
class GamificationTransformer extends TransformerAbstract
{
    /**
     * Transform the Gamification entity.
     *
     * @param \App\Entities\Gamification $model
     *
     * @return array
     */
    public function transform(Gamification $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
