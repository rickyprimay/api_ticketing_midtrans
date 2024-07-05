<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $primaryKey = 'event_id';
    
    protected $fillable = [
        'event_name',
        'users_id',
        'event_description',
        'event_location',
        'event_picture',
        'price',
        'event_date',
        'event_status',
        'event_start',
        'event_ended'
    ];

    public function tickets()
    {
        return $this->hasMany(Tickets::class, 'events_id', 'event_id');
    }

    public function talents()
    {
        return $this->hasMany(Talents::class, 'event_id');
    }
    public function user()
    {
        return $this->belongsTo(Users::class, 'users_id');
    }
}
