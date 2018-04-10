<?php

namespace App\Presenters;

use App\Transformers\ResidentialCoverageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ResidentialCoveragePresenter.
 *
 * @package namespace App\Presenters;
 */
class ResidentialCoveragePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ResidentialCoverageTransformer();
    }
}
