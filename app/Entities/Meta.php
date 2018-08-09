<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Meta.
 *
 * @package namespace App\Entities;
 */
class Meta extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'description',
        // 'production_meta',
        // 'production_real',
        // 'production_percentage',
        // 'day',
        // 'employer_id',
        // 'created_by',
        'description',
        'month',
        'daily_sales',
        'employer_id',
        'created_by',
        'insurance_type_id',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

//criado por
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function insurance()
    {
        return $this->belongsTo(InsuranceType::class, 'insurance_type_id');
    }

}
