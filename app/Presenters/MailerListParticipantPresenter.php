<?php

namespace App\Presenters;

use App\Transformers\MailerListParticipantTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MailerListParticipantPresenter.
 *
 * @package namespace App\Presenters;
 */
class MailerListParticipantPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MailerListParticipantTransformer();
    }
}
