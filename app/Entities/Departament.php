<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Departament.
 *
 * @package namespace App\Entities;
 */
class Departament extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'telephone',
        'email',
        'whatsapp',
        'broker_id'
    ];

    public function employer()
    {
        return $this->hasOne(Employer::class, 'departament_id');
    }

    public function broker()
    {
        return $this->belongsTo(Broker::class, 'broker_id');
    }

}
