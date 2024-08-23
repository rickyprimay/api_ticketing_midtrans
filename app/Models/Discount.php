<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'discount';

    use HasFactory;
    protected $quarded = [];
    
    protected $fillable = [
        'event_id',
        'ticket_id',
        'total_discount',
        'code',
        'used',
    ];

    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }

    // Relasi dengan model Ticket
    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id');
    }
}
