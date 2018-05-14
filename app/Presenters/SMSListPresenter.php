<?php

namespace App\Presenters;

use App\Transformers\SMSListTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SMSListPresenter.
 *
 * @package namespace App\Presenters;
 */
class SMSListPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SMSListTransformer();
    }
}
