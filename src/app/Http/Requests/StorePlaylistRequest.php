<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * プレイリスト作成リクエスト
 *
 * APIでプレイリストを新規作成する際のバリデーションルールを定義します。
 */
class StorePlaylistRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'nullable|string',
        ];
    }

    /**
     * バリデーションエラーメッセージ（日本語）
     */
    public function messages(): array
    {
        return [
            'title.required' => 'タイトルは必須です。',
            'title.max' => 'タイトルは255文字以内で入力してください。',
        ];
    }
}
