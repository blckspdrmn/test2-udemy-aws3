<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
