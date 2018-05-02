<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Chats.
 *
 * @package namespace App\Entities;
 */
class Chats extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clerck_id',
        'client_id',
    ];

    public function clerck()
    {
        return $this->belongsTo(User::class, 'clerck_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function chat_messages()
    {
        return $this->hasMany(Conversation::class, 'chats_id');
    }

}
