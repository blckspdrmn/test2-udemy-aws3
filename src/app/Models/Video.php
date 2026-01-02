<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'playlist_id',
        'youtube_id',
        'title',
    ];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}
