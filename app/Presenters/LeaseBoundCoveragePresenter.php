<?php

namespace App\Presenters;

use App\Transformers\LeaseBoundCoverageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LeaseBoundCoveragePresenter.
 *
 * @package namespace App\Presenters;
 */
class LeaseBoundCoveragePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LeaseBoundCoverageTransformer();
    }
}
