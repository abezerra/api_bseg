<?php

namespace App\Presenters;

use App\Transformers\MessageReplyTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MessageReplyPresenter.
 *
 * @package namespace App\Presenters;
 */
class MessageReplyPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MessageReplyTransformer();
    }
}
