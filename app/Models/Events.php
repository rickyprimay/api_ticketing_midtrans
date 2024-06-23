<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $primaryKey = 'event_id';
    
    protected $fillable = [
        'event_name',
        'event_description',
        'event_location',
        'event_picture',
        'price',
        'event_date',
        'event_status',
    ];

    // Relationship with Tickets
    public function tickets()
    {
        return $this->hasMany(Tickets::class, 'events_id');
    }

    // Relationship with Talents
    public function talents()
    {
        return $this->hasMany(Talents::class, 'event_id');
    }
}
