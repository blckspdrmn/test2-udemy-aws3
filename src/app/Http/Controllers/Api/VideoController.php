<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Resources\VideoCollection;
use App\Http\Resources\VideoResource;
use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Http\JsonResponse;

/**
 * Video API Controller
 *
 * プレイリストに紐づく動画リソースの操作を REST API として提供します。
 * すべてのレスポンスは JSON 形式で返されます。
 *
 * エンドポイント:
 * - GET    /api/playlists/{playlist}/videos        - 動画一覧取得
 * - POST   /api/playlists/{playlist}/videos        - 動画追加
 * - DELETE /api/playlists/{playlist}/videos/{video} - 動画削除
 */
class VideoController extends Controller
{
    /**
     * プレイリストの動画一覧を取得
     *
     * GET /api/playlists/{playlist}/videos
     *
     * @param Playlist $playlist Route Model Bindingで自動取得
     * @return VideoCollection
     */
    public function index(Playlist $playlist): VideoCollection
    {
        // プレイリストに紐づく動画を取得
        $videos = $playlist->videos;

        return new VideoCollection($videos);
    }

    /**
     * プレイリストに動画を追加
     *
     * POST /api/playlists/{playlist}/videos
     *
     * @param StoreVideoRequest $request
     * @param Playlist $playlist Route Model Bindingで自動取得
     * @return JsonResponse
     */
    public function store(StoreVideoRequest $request, Playlist $playlist): JsonResponse
    {
        // バリデーション済みデータで動画を作成
        // リレーション経由で作成することで、playlist_idが自動設定される
        $video = $playlist->videos()->create($request->validated());

        // 201 Createdステータスコードで返す
        return (new VideoResource($video))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * プレイリストから動画を削除
     *
     * DELETE /api/playlists/{playlist}/videos/{video}
     *
     * @param Playlist $playlist Route Model Bindingで自動取得
     * @param Video $video Route Model Bindingで自動取得
     * @return JsonResponse
     */
    public function destroy(Playlist $playlist, Video $video): JsonResponse
    {
        // 動画が指定されたプレイリストに属しているか確認
        if ($video->playlist_id !== $playlist->id) {
            return response()->json([
                'message' => 'この動画は指定されたプレイリストに属していません。'
            ], 404);
        }

        // 動画を削除
        $video->delete();

        // 204 No Contentステータスコードで返す（ボディなし）
        return response()->json(null, 204);
    }
}
