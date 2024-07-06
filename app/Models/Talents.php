<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Talents extends Model
{
    use HasFactory;
    protected $primaryKey = 'talent_id';
    
    protected $fillable = [
        'name',
        'event_id',
    ];

    // Relationship with Event
    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }
    protected function talentImage(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? url('storage/' . $value) : null,
        );
    }
}
