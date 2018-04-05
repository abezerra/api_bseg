<?php

namespace App\Presenters;

use App\Transformers\DefaultsTemplatingTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DefaultsTemplatingPresenter.
 *
 * @package namespace App\Presenters;
 */
class DefaultsTemplatingPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DefaultsTemplatingTransformer();
    }
}
