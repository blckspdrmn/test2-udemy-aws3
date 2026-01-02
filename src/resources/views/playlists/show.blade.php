@extends('layouts.app')

@section('content')
<div class="px-4 sm:px-0">
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900">{{ $playlist->title }}</h1>
            <a href="{{ route('playlists.index') }}" class="text-blue-500 hover:text-blue-700">
                ← 一覧に戻る
            </a>
        </div>
        @if($playlist->description)
            <p class="text-gray-600 mt-2">{{ $playlist->description }}</p>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">動画を追加</h2>
            <form action="{{ route('videos.store', $playlist) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="youtube_id" class="block text-gray-700 text-sm font-bold mb-2">
                        YouTube動画ID<span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="youtube_id" id="youtube_id" value="{{ old('youtube_id') }}" placeholder="例: dQw4w9WgXcQ"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('youtube_id') border-red-500 @enderror">
                    <p class="text-gray-500 text-xs mt-1">YouTubeのURLから「v=」の後の部分をコピーしてください</p>
                    @error('youtube_id')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                        タイトル<span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    追加
                </button>
            </form>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">動画一覧 ({{ $playlist->videos->count() }}件)</h2>

            @if($playlist->videos->isEmpty())
                <p class="text-gray-500">まだ動画が追加されていません。</p>
            @else
                <div class="space-y-4">
                    @foreach($playlist->videos as $video)
                        <div class="border-b pb-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-gray-900">{{ $video->title }}</h3>
                                <form action="{{ route('videos.destroy', [$playlist, $video]) }}" method="POST" onsubmit="return confirm('この動画を削除しますか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                                        削除
                                    </button>
                                </form>
                            </div>
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe
                                    class="w-full h-48 rounded"
                                    src="https://www.youtube.com/embed/{{ $video->youtube_id }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">ID: {{ $video->youtube_id }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
