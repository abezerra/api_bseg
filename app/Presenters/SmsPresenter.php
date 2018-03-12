<?php

namespace App\Presenters;

use App\Transformers\SmsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SmsPresenter.
 *
 * @package namespace App\Presenters;
 */
class SmsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SmsTransformer();
    }
}
