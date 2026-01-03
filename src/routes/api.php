<?php

use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\Api\VideoController;
use Illuminate\Support\Facades\Route;

/**
 * API Routes
 *
 * このファイルでは、アプリケーションのAPIエンドポイントを定義します。
 * すべてのルートには自動的に'/api'プレフィックスが付きます。
 *
 * 例: Route::get('playlists') は /api/playlists としてアクセス可能
 */

// Playlists リソースルート
// GET    /api/playlists           - 全プレイリスト一覧
// GET    /api/playlists/{id}      - プレイリスト詳細
// POST   /api/playlists           - プレイリスト作成
// PUT    /api/playlists/{id}      - プレイリスト更新
// DELETE /api/playlists/{id}      - プレイリスト削除
Route::apiResource('playlists', PlaylistController::class);

// Videos ネストルート
// GET    /api/playlists/{playlist}/videos        - プレイリストの動画一覧
// POST   /api/playlists/{playlist}/videos        - 動画追加
// DELETE /api/playlists/{playlist}/videos/{video} - 動画削除
Route::get('playlists/{playlist}/videos', [VideoController::class, 'index']);
Route::post('playlists/{playlist}/videos', [VideoController::class, 'store']);
Route::delete('playlists/{playlist}/videos/{video}', [VideoController::class, 'destroy']);
