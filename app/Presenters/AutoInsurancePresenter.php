<?php

namespace App\Presenters;

use App\Transformers\AutoInsuranceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AutoInsurancePresenter.
 *
 * @package namespace App\Presenters;
 */
class AutoInsurancePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AutoInsuranceTransformer();
    }
}
