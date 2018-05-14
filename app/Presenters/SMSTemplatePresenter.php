<?php

namespace App\Presenters;

use App\Transformers\SMSTemplateTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SMSTemplatePresenter.
 *
 * @package namespace App\Presenters;
 */
class SMSTemplatePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SMSTemplateTransformer();
    }
}
