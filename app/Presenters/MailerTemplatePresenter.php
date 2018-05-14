<?php

namespace App\Presenters;

use App\Transformers\MailerTemplateTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MailerTemplatePresenter.
 *
 * @package namespace App\Presenters;
 */
class MailerTemplatePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MailerTemplateTransformer();
    }
}
