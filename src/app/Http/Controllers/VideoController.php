<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Playlist $playlist)
    {
        $validated = $request->validate([
            'youtube_id' => 'required|max:255',
            'title' => 'required|max:255',
        ]);

        $playlist->videos()->create($validated);

        return redirect()->route('playlists.show', $playlist)
            ->with('success', '動画が追加されました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist, Video $video)
    {
        $video->delete();

        return redirect()->route('playlists.show', $playlist)
            ->with('success', '動画が削除されました。');
    }
}
