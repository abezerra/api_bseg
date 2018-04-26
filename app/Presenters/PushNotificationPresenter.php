<?php

namespace App\Presenters;

use App\Transformers\PushNotificationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PushNotificationPresenter.
 *
 * @package namespace App\Presenters;
 */
class PushNotificationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PushNotificationTransformer();
    }
}
