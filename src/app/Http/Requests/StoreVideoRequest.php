<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * 動画追加リクエスト
 *
 * APIでプレイリストに動画を追加する際のバリデーションルールを定義します。
 */
class StoreVideoRequest extends FormRequest
{
    /**
     * このリクエストを実行する権限があるか判定
     */
    public function authorize(): bool
    {
        // 学習用のため、認証なしで全ユーザーに許可
        return true;
    }

    /**
     * バリデーションルール
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'youtube_id' => 'required|max:255',
            'title' => 'required|max:255',
        ];
    }

    /**
     * バリデーションエラーメッセージ（日本語）
     */
    public function messages(): array
    {
        return [
            'youtube_id.required' => 'YouTube IDは必須です。',
            'youtube_id.max' => 'YouTube IDは255文字以内で入力してください。',
            'title.required' => 'タイトルは必須です。',
            'title.max' => 'タイトルは255文字以内で入力してください。',
        ];
    }
}
