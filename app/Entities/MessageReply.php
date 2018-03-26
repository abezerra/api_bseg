<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MessageReply.
 *
 * @package namespace App\Entities;
 */
class MessageReply extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message_id',
        'body',
        'attachmet',
        'replyer_id',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'replyer_id');
    }

}
