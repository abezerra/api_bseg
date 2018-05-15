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

    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(MessageReply::class, 'replyer_id');
    }

    public function templates()
    {
        return $this->hasMany(Templating::class, 'user_id');
    }

    public function defaults()
    {
        return $this->hasMany(DefaultsTemplating::class, 'created_by');
    }

    public function sender()
    {
        return $this->hasMany(Conversation::class, 'clerck_id');
    }

    public function receiver()
    {
        return $this->hasMany(Conversation::class, 'client_id');
    }

    public function chat_clerck()
    {
        return $this->hasMany(Chats::class, 'clerck_id');
    }

    public function chat_clients()
    {
        return $this->hasMany(Chats::class, 'client_id');
    }

    public function push()
    {
        return $this->hasMany(PushNotification::class, 'sended_by');
    }

    public function mail_template()
    {
        return $this->hasMany(MailerTemplate::class, 'created_by');
    }

    public function mail_list()
    {
        return $this->hasMany(MailerList::class, 'created_by');
    }

    public function sms_list()
    {
        return $this->hasMany(SMSList::class, 'created_by');
    }

    public function sms_template()
    {
        return $this->hasMany(SMSTemplate::class, 'created_by');
    }

    public function participants()
    {
        return $this->hasMany(MailerListParticipant::class, 'created_by');
    }
}
