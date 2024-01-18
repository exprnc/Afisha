<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $table = "genres";
    protected $guarded = false;

    public function events()
    {
        return $this->hasManyThrough(Event::class, Subgenre::class);
    }
}
