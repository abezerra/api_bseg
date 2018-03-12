<?php

namespace App\Presenters;

use App\Transformers\IndividualLifeInsuranceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class IndividualLifeInsurancePresenter.
 *
 * @package namespace App\Presenters;
 */
class IndividualLifeInsurancePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new IndividualLifeInsuranceTransformer();
    }
}
