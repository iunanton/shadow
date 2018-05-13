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

    private function transformHeight()
    {
        return 1.2 + 0.1 * ($this->attributes['height'] - 1);
    }

    private function transformWeight()
    {
        return 35 + 5 * ($this->attributes['weight'] - 1);
    }

    /**
     * Get the user's age.
     *
     * @return integer
     */
    public function getHeightSIAttribute()
    {
        if (is_null($this->attributes['height'])) {
            return 'not specified';
        }

        switch ($this->attributes['height']) {
            case 0:
                return 'below 1.2';
            case 13:
                return '2.4 and above';
            default:
                return $this->transformHeight();
        }
    }

    /**
     * Get the user's age.
     *
     * @return integer
     */
    public function getWeightSIAttribute()
    {
        if (is_null($this->attributes['weight'])) {
            return 'not specified';
        }

        switch ($this->attributes['weight']) {
            case 0:
                return 'below 35';
            case 20:
                return '130 and above';
            default:
                return $this->transformWeight();
        }
    }

    /**
     * Get the user's age.
     *
     * @return integer
     */
    public function getBMIAttribute()
    {
        if (is_null($this->attributes['height']) || is_null($this->attributes['weight'])) {
            return 0;
        }
        $height = $this->transformHeight();
        $weight = $this->transformWeight();
        return round($weight / $height / $height);
    }
}
