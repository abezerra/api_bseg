<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Mailer.
 *
 * @package namespace App\Entities;
 */
class Mailer extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from',
        'sender',
        'to',
        'message',
        'cc',
        'bcc',
        'replyTo',
        'subject',
        'priority',
        'attach',
        'attachData',
    ];

}
