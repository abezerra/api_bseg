<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AutoInsurance.
 *
 * @package namespace App\Entities;
 */
class AutoInsurance extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'cpf',
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
        'veichle',
        'board',
        'yearOfManufacture',
        'yearOfModel',
        'coverage_id',
        'file',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function coverage()
    {
        return $this->hasMany(Coverage::class, 'insurer_id');
    }

}
