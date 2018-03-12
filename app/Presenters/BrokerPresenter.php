<?php

namespace App\Presenters;

use App\Transformers\BrokerTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BrokerPresenter.
 *
 * @package namespace App\Presenters;
 */
class BrokerPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BrokerTransformer();
    }
}
