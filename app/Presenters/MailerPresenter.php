<?php

namespace App\Presenters;

use App\Transformers\MailerTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MailerPresenter.
 *
 * @package namespace App\Presenters;
 */
class MailerPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MailerTransformer();
    }
}
