<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'cpf',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function client()
    {
        return $this->hasMany(Client::class, 'user_id');
    }

    public function employer()
    {
        return $this->hasOne(Employer::class, 'user_id');
    }

    public function notification()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class, 'user_id');
    }
}
