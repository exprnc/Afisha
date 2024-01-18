<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Watch extends Model
{
    use HasFactory;
    protected $table = "watched";
    protected $guarded = false;

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
