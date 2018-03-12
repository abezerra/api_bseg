<?php

namespace App\Presenters;

use App\Transformers\EmployerTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EmployerPresenter.
 *
 * @package namespace App\Presenters;
 */
class EmployerPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EmployerTransformer();
    }
}
