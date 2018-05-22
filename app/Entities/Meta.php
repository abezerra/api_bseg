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
        'description',
        'production_meta',
        'production_real',
        'rate_profit_meta',
        'rate_profit_real',
        'app_downloads_number_meta',
        'app_downloads_number_real',
        'news_contracts_meta',
        'news_contracts_real',
        'percentage_of_renovations_meta',
        'percentage_of_renovations_real',
        'percentage_of_insurances_versus_news_meta',
        'percentage_of_insurances_versus_news_real',
        'employer_id',
        'created_by',
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

}
