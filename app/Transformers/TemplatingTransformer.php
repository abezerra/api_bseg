<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Templating;

/**
 * Class TemplatingTransformer.
 *
 * @package namespace App\Transformers;
 */
class TemplatingTransformer extends TransformerAbstract
{
    /**
     * Transform the Templating entity.
     *
     * @param \App\Entities\Templating $model
     *
     * @return array
     */
    public function transform(Templating $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
