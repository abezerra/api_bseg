<?php

namespace App\Presenters;

use App\Transformers\CoverageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CoveragePresenter.
 *
 * @package namespace App\Presenters;
 */
class CoveragePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CoverageTransformer();
    }
}
