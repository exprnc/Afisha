<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EventPerformer extends Model
{
    use HasFactory;
    protected $table = "events_performers";
    protected $guarded = false;

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function performer()
    {
        return $this->belongsTo(Performer::class, 'performer_id', 'id');
    }
}
