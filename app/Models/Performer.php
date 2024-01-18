<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Performer extends Model
{
    use HasFactory;
    protected $table = "performers";
    protected $guarded = false;

    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_performers', 'performer_id', 'event_id');
    }
}
