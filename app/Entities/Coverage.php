<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Coverage.
 *
 * @package namespace App\Entities;
 */
class Coverage extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'insurer_id',
			'coverage',
			'value',
			'franchise',
    ];


    public function life()
    {
        return $this->hasMany(IndividualLifeInsurance::class, 'coverage_id');
    }

    public function residential()
    {
        return $this->hasMany(ResidentialInsurance::class, 'coverage_id');
    }

    public function lease()
    {
        return $this->hasMany(LeaseBoundInsurance::class, 'coverage_id');
    }

    public function auto()
    {
        return $this->belongsTo(AutoInsurance::class, 'insurer_id');
    }

    public function eo()
    {
        return $this->hasMany(EOInsurance::class, 'coverage_id');
    }
}
