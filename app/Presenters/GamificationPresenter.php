<?php

namespace App\Presenters;

use App\Transformers\GamificationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class GamificationPresenter.
 *
 * @package namespace App\Presenters;
 */
class GamificationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new GamificationTransformer();
    }
}
