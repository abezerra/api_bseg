<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class LeaseBoundInsurance.
 *
 * @package namespace App\Entities;
 */
class LeaseBoundInsurance extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpf',
        'insurer',
        'apoliceNumber',
        'validity',
        'accession',
        'classification',
        'input',
        'value',
        'totalOfPortions',
        'paymentForm',
        'portion',
        'date',
        'portionValue',
        'client_id',
        'localeOfRisc',
        'administrator',
        'duartion',
        'coverage_id',
        'file',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function coverage()
    {
        return $this->hasMany(LeaseBoundCoverage::class, 'insurer_id');
    }
}
