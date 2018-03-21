<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EOCoverage.
 *
 * @package namespace App\Entities;
 */
class EOCoverage extends Model implements Transformable
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

    public function eo()
    {
        return $this->belongsTo(EOInsurance::class, 'insurer_id');
    }

}
