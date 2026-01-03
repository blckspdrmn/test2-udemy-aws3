<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Video Collection Resource
 *
 * 動画のコレクション（複数）のJSON レスポンス形式を定義します。
 * プレイリストの動画一覧取得APIなどで使用されます。
 */
class VideoCollection extends ResourceCollection
{
    /**
     * コレクションを配列に変換
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
