<?php

namespace App\Presenters;

use App\Transformers\LeaseBoundInsuranceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LeaseBoundInsurancePresenter.
 *
 * @package namespace App\Presenters;
 */
class LeaseBoundInsurancePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LeaseBoundInsuranceTransformer();
    }
}
