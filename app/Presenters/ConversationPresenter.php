<?php

namespace App\Presenters;

use App\Transformers\ConversationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ConversationPresenter.
 *
 * @package namespace App\Presenters;
 */
class ConversationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ConversationTransformer();
    }
}
