<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Gamification.
 *
 * @package namespace App\Entities;
 */
class Gamification extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employer_id',
        'points'
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }
}
