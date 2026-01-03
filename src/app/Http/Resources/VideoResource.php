<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Video API Resource
 *
 * 動画のJSON レスポンス形式を定義します。
 * このクラスは、Videoモデルをクライアント向けのJSON形式に変換します。
 */
class VideoResource extends JsonResource
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
            'youtube_id' => $this->youtube_id,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
