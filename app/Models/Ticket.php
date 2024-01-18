<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;
    protected $table = "tickets";
    protected $guarded = false;

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
