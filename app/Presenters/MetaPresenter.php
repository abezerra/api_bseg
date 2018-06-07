<?php

namespace App\Presenters;

use App\Transformers\MetaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MetaPresenter.
 *
 * @package namespace App\Presenters;
 */
class MetaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MetaTransformer();
    }
}
