<?php

namespace App;

use Laravel\Cashier\Billable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,Billable;

    
    protected $fillable = [
        'name', 'slug', 'email', 'confirmation_code', 'password', 'no_registry', 'identification_card',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /*public function patients()
    {
        return $this->hasMany('App\Patient');
    }*/

    public function events()
    {
        return $this->hasmany('App\Event');
    }

    public function hasRoles($role)
    {
        //return $this->role === $role;
        return $this->rol->rol === $role;
    }

    public function rol(){
        return $this->hasOne('App\Rol', 'id', 'role_id');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function patients()
    {
        return $this->hasMany('App\Patient');
    }
}