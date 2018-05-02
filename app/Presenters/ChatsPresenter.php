<?php

namespace App\Presenters;

use App\Transformers\ChatsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ChatsPresenter.
 *
 * @package namespace App\Presenters;
 */
class ChatsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ChatsTransformer();
    }
}
