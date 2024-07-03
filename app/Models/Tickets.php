<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $primaryKey = 'ticket_id';
    
    protected $fillable = [
        'users_id',
        'events_id',
        'price',
        'ticket_status',
        'payment_status',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'users_id');
    }

    // Relationship with Event
    public function event()
    {
        return $this->belongsTo(Events::class, 'events_id');
    }
}
