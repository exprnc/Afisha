<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    protected $table = "events";
    protected $guarded = false;

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    public function age()
    {
        return $this->belongsTo(AgeLimit::class, 'age_limit_id', 'id');
    }

    public function subgenre()
    {
        return $this->belongsTo(Subgenre::class, 'subgenre_id', 'id');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->attributes['date'])->format('d.m.Y');
    }

    public function getFormattedTimeAttribute()
    {
        return Carbon::parse($this->attributes['time'])->format('H:i');
    }

    public function performers()
    {
        return $this->belongsToMany(Performer::class, 'events_performers', 'event_id', 'performer_id');
    }

    public function isLikedByUser($userId)
    {
        return $this->favorites()->where('user_id', $userId)->exists();
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
