@extends('layouts.app')

@section('content')
<div class="px-4 sm:px-0">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">再生リスト一覧</h1>

    @if($playlists->isEmpty())
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <p class="text-gray-500">まだ再生リストがありません。</p>
            <a href="{{ route('playlists.create') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                最初の再生リストを作成
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($playlists as $playlist)
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $playlist->title }}</h2>
                    @if($playlist->description)
                        <p class="text-gray-600 mb-4">{{ Str::limit($playlist->description, 100) }}</p>
                    @endif
                    <div class="text-sm text-gray-500 mb-4">
                        動画数: {{ $playlist->videos->count() }}
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('playlists.show', $playlist) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            表示
                        </a>
                        <a href="{{ route('playlists.edit', $playlist) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            編集
                        </a>
                        <form action="{{ route('playlists.destroy', $playlist) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                削除
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
