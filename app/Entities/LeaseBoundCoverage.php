<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class LeaseBoundCoverage.
 *
 * @package namespace App\Entities;
 */
class LeaseBoundCoverage extends Model implements Transformable
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

    public function coverage()
    {
        return $this->belongsTo(LeaseBoundInsurance::class, 'insurer_id');
    }

}
