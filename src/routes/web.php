<?php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('playlists.index');
});

Route::resource('playlists', PlaylistController::class);
Route::post('playlists/{playlist}/videos', [VideoController::class, 'store'])->name('videos.store');
Route::delete('playlists/{playlist}/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');
