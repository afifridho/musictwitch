<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id', 'username', 'is_live'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function followers()
    {
      return $this->belongsToMany('App\User', 'followers', 'users_id', 'followers_id');
    }

    public function following()
    {
      return $this->belongsToMany('App\User', 'followings', 'users_id', 'followings_id');
    }
}
