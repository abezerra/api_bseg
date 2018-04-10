<?php

namespace App\Presenters;

use App\Transformers\LifeCoverageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LifeCoveragePresenter.
 *
 * @package namespace App\Presenters;
 */
class LifeCoveragePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LifeCoverageTransformer();
    }
}
