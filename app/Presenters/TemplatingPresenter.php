<?php

namespace App\Presenters;

use App\Transformers\TemplatingTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TemplatingPresenter.
 *
 * @package namespace App\Presenters;
 */
class TemplatingPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TemplatingTransformer();
    }
}
