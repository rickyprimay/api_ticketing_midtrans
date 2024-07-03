<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketUsers extends Model
{
    protected $primaryKey = 'id';
    use HasFactory;
    protected $quarded = [];
}
