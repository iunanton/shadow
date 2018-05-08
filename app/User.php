<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'username', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $incrementing = false;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    public function isSuperAdmin()
    {
        return in_array($this->id, ['Ciuc7Hwfaiqum02w']);
    }

    /**
     * Get the user's profile.
     */
    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public function videos()
    {
        return $this->hasMany('App\Video');
    }
}
