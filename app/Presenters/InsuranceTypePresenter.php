<?php

namespace App\Presenters;

use App\Transformers\InsuranceTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InsuranceTypePresenter.
 *
 * @package namespace App\Presenters;
 */
class InsuranceTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InsuranceTypeTransformer();
    }
}
