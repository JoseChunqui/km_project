<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MyOwnResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function role(){
      return $this->belongsto('App\User');
    }
    public function institution(){
      return $this->belongsto('App\Institution');
    }

    public function courses(){
      return $this->hasMany('App\Course');
    }

    public function sendPasswordResetNotification($token)
    {
      $this->notify(new ResetPasswordNotification($token));
    }

    //roles
    public function isAdmin(){
      return $this->role->name == 'admin' ? true : false;
    }

}
