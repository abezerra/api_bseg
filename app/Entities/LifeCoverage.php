<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class LifeCoverage.
 *
 * @package namespace App\Entities;
 */
class LifeCoverage extends Model implements Transformable
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
        return $this->belongsTo(IndividualLifeInsurance::class, 'insurer_id');
    }

}
