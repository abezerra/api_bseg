<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Conversation.
 *
 * @package namespace App\Entities;
 */
class Conversation extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chats_id',
        'clerck_id',
        'client_id',
        'message',
        'attachment',
        'user_id'
    ];

    public function receiver()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'clerck_id');
    }

    public function chat()
    {
        return $this->belongsTo(Chats::class, 'chats_id');
    }

}
