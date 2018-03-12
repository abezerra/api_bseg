<?php

namespace App\Presenters;

use App\Transformers\EOInsuranceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EOInsurancePresenter.
 *
 * @package namespace App\Presenters;
 */
class EOInsurancePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EOInsuranceTransformer();
    }
}
