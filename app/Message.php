<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'sender_id', 'recipient_id',
    ];

    public $incrementing = false;

    /**
     * Get the sender.
     */
    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id');
    }

    /**
     * Get the recipient.
     */
    public function recipient()
    {
        return $this->belongsTo('App\User', 'recipient_id');
    }
}
