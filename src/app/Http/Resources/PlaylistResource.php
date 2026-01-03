<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Playlist API Resource
 *
 * プレイリストのJSON レスポンス形式を定義します。
 * このクラスは、Playlistモデルをクライアント向けのJSON形式に変換します。
 */
class PlaylistResource extends JsonResource
{
    /**
     * リソースを配列に変換
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,

            // 動画数を含める（withCount('videos')が使われている場合のみ）
            'videos_count' => $this->when(
                isset($this->videos_count),
                $this->videos_count
            ),

            // 動画リストを含める（with('videos')でロードされている場合のみ）
            'videos' => VideoResource::collection(
                $this->whenLoaded('videos')
            ),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
