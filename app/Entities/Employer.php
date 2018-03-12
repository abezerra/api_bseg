<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Employer.
 *
 * @package namespace App\Entities;
 */
class Employer extends Model implements Transformable
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
			'registration',
			'departament_id',
			'user_id',
			'goals_daily',
			'goals_weekely',
			'goals_motly',
    ];

    public function departament() 
    {
        return $this->belongsTo(Departament::class, 'departament_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function gamification()
    {
        return $this->hasMany(Gamification::class, 'employer_id');
    }
}
