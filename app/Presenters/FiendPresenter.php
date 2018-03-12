<?php

namespace App\Presenters;

use App\Transformers\FiendTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FiendPresenter.
 *
 * @package namespace App\Presenters;
 */
class FiendPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FiendTransformer();
    }
}
