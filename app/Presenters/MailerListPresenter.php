<?php

namespace App\Presenters;

use App\Transformers\MailerListTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MailerListPresenter.
 *
 * @package namespace App\Presenters;
 */
class MailerListPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MailerListTransformer();
    }
}
