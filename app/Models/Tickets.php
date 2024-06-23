<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $primaryKey = 'ticket_id';
    
    protected $fillable = [
        'users_id',
        'events_id',
        'name_user',
        'birth_date_user',
        'email_user',
        'gender_user',
        'price',
        'ticket_status',
        'order_id',
        'quantity',
        'payment_url',
        'payment_status',
    ];

    // Relationship with User
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
