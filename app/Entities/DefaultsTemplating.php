<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class DefaultsTemplating.
 *
 * @package namespace App\Entities;
 */
class DefaultsTemplating extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'media_name',
        'media_url',
        'status',
        'created_by',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
