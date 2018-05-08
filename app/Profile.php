<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'dateOfBirth', 'displayDOB', 'height', 'weight', 'description',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'user_id';
    }

    /**
     * Get the user's age.
     *
     * @return integer
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['dateOfBirth'])->age;
    }

    /**
     * Get the user's age.
     *
     * @return integer
     */
    public function getHeightSIAttribute()
    {
        if (is_null($this->attributes['height']))
        {
            return 0;
        }
        $min = 1.2;
        $gap = 0.005;
        return $min + $this->attributes['height'] * $gap;
    }

    /**
     * Get the user's age.
     *
     * @return integer
     */
    public function getWeightSIAttribute()
    {
        if (is_null($this->attributes['weight']))
        {
            return 0;
        }
        $min = 35;
        $gap = 0.5;
        return $min + $this->attributes['weight'] * $gap;
    }

    /**
     * Get the user's age.
     *
     * @return integer
     */
    public function getBMIAttribute()
    {
        if (is_null($this->attributes['height']) || is_null($this->attributes['weight']))
        {
            return 0;
        }
        $height = 1.2 + $this->attributes['height'] * 0.005;
        $weight = 35 + $this->attributes['weight'] * 0.5;
        return $weight / $height / $height;
    }

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
