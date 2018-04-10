<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ResidentialInsurance.
 *
 * @package namespace App\Entities;
 */
class ResidentialInsurance extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'insurer',
        'cpf',
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
        'city',
        'neigbrhood',
        'cep',
        'coverage_id',
        'file',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function coverage()
    {
        return $this->hasMany(ResidentialCoverage::class, 'insurer_id');
    }

}
