<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Client.
 *
 * @package namespace App\Entities;
 */
class Client extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cpf',
		'rg',
		'ddd_phone',
		'telefone',
		'ddd_cellphone',
		'cellphone',
		'email',
		'whatsapp',
		'address',
		'street',
		'neighbhrood',
		'city',
		'uf',
		'birth',
		'from',
        'type',
		'user_id',
	];
	
	public function user() 
	{
		return $this->belongsTo(User::class, 'user_id');
	}

    public function eo()
    {
        return $this->hasMany(EOInsurance::class, 'client_id');
	}

    public function individual()
    {
        return $this->hasMany(IndividualLifeInsurance::class, 'client_id');
	}

    public function residential()
    {
        return $this->hasMany(ResidentialInsurance::class, 'client_id');
    }

    public function lease()
    {
        return $this->hasMany(LeaseBoundInsurance::class, 'client_id');
    }

    public function auto()
    {
        return $this->hasMany(AutoInsurance::class, 'client_id');
    }

}
