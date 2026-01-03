<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlaylistRequest;
use App\Http\Requests\UpdatePlaylistRequest;
use App\Http\Resources\PlaylistCollection;
use App\Http\Resources\PlaylistResource;
use App\Models\Playlist;
use Illuminate\Http\JsonResponse;

/**
 * Playlist API Controller
 *
 * プレイリストリソースの CRUD 操作を REST API として提供します。
 * すべてのレスポンスは JSON 形式で返されます。
 *
 * エンドポイント:
 * - GET    /api/playlists       - 一覧取得
 * - GET    /api/playlists/{id}  - 詳細取得
 * - POST   /api/playlists       - 新規作成
 * - PUT    /api/playlists/{id}  - 更新
 * - DELETE /api/playlists/{id}  - 削除
 */
class PlaylistController extends Controller
{
    /**
     * 全プレイリストの一覧を取得
     *
     * GET /api/playlists
     *
     * @return PlaylistCollection
     */
    public function index(): PlaylistCollection
    {
        // N+1問題を避けるため、withCount()で動画数を取得
        // latest()で新しい順に並び替え
        $playlists = Playlist::withCount('videos')
            ->latest()
            ->get();

        return new PlaylistCollection($playlists);
    }

    /**
     * 新規プレイリストを作成
     *
     * POST /api/playlists
     *
     * @param StorePlaylistRequest $request
     * @return JsonResponse
     */
    public function store(StorePlaylistRequest $request): JsonResponse
    {
        // バリデーション済みデータでプレイリストを作成
        $playlist = Playlist::create($request->validated());

        // 201 Createdステータスコードで返す
        return (new PlaylistResource($playlist))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * 特定のプレイリストの詳細を取得
     *
     * GET /api/playlists/{id}
     *
     * @param Playlist $playlist Route Model Bindingで自動取得
     * @return PlaylistResource
     */
    public function show(Playlist $playlist): PlaylistResource
    {
        // 関連する動画も一緒に取得（N+1問題を回避）
        $playlist->load('videos');

        return new PlaylistResource($playlist);
    }

    /**
     * プレイリストを更新
     *
     * PUT/PATCH /api/playlists/{id}
     *
     * @param UpdatePlaylistRequest $request
     * @param Playlist $playlist Route Model Bindingで自動取得
     * @return PlaylistResource
     */
    public function update(UpdatePlaylistRequest $request, Playlist $playlist): PlaylistResource
    {
        // バリデーション済みデータで更新
        $playlist->update($request->validated());

        return new PlaylistResource($playlist);
    }

    /**
     * プレイリストを削除
     *
     * DELETE /api/playlists/{id}
     *
     * @param Playlist $playlist Route Model Bindingで自動取得
     * @return JsonResponse
     */
    public function destroy(Playlist $playlist): JsonResponse
    {
        // プレイリストを削除（関連動画も自動削除: onDelete cascade）
        $playlist->delete();

        // 204 No Contentステータスコードで返す（ボディなし）
        return response()->json(null, 204);
    }
}
