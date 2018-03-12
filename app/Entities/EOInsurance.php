<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EOInsurance.
 *
 * @package namespace App\Entities;
 */
class EOInsurance extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'insurer',
        'apoliceNumber',
        'validity',
        'classification',
        'input',
        'value',
        'totalOfPortions',
        'paymentForm',
        'portion',
        'date',
        'portionValue',
        'client_id',
        'taker',
        'cnpj',
        'coverage_id',
        'file',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function coverage()
    {
        return $this->belongsTo(Coverage::class, 'coverage_id');
    }
}
