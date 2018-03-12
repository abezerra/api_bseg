<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Broker.
 *
 * @package namespace App\Entities;
 */
class Broker extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'name',
        'description',
        'slogan',
        'ddd',
        'cellphone',
        'telephone',
        'email',
        'site',
        'cep',
        'ibge_code',
        'address',
        'neighborhood',
        'complement',
        'city',
        'uf',
    ];

    public function departament()
    {
        return $this->hasMany(Departament::class, 'broker_id');
    }

}
