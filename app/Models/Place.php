<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $table = "places";
    protected $guarded = false;

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'place_id');
    }
}
