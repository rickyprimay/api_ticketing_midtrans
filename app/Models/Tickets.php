<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $primaryKey = 'ticket_id';
    
    protected $fillable = [
        'ticket_type',
        'events_id',
        'price',
    ];


    // Relationship with Event
    public function event()
    {
        return $this->belongsTo(Events::class, 'events_id', 'event_id');
    }
}
