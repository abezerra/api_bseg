<?php

namespace App\Presenters;

use App\Transformers\EOCoverageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EOCoveragePresenter.
 *
 * @package namespace App\Presenters;
 */
class EOCoveragePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EOCoverageTransformer();
    }
}
