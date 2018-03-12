<?php

namespace App\Presenters;

use App\Transformers\ResidentialInsuranceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ResidentialInsurancePresenter.
 *
 * @package namespace App\Presenters;
 */
class ResidentialInsurancePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ResidentialInsuranceTransformer();
    }
}
