<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PushNotification.
 *
 * @package namespace App\Entities;
 */
class PushNotification extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'heading',
        'subtitle',
        'message',
        'sended_by',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sended_by');
    }
}
