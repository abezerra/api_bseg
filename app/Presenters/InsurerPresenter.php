<?php

namespace App\Presenters;

use App\Transformers\InsurerTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InsurerPresenter.
 *
 * @package namespace App\Presenters;
 */
class InsurerPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InsurerTransformer();
    }
}
