<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MailerListParticipant.
 *
 * @package namespace App\Entities;
 */
class MailerListParticipant extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mailer_lists_id',
        'client_id',
        'created_by',
    ];

    public function listy()
    {
        return $this->belongsTo(MailerList::class, 'mailer_lists_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
