@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">API Test Dashboard</h1>
        <p class="text-gray-600">このページでREST APIの動作をテストできます</p>
    </div>

    <!-- タブナビゲーション -->
    <div class="mb-6 border-b border-gray-200">
        <nav class="-mb-px flex space-x-8">
            <button onclick="switchTab('playlists')" id="tab-playlists" class="tab-button border-b-2 border-blue-500 py-4 px-1 text-sm font-medium text-blue-600">
                Playlists API
            </button>
            <button onclick="switchTab('videos')" id="tab-videos" class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                Videos API
            </button>
        </nav>
    </div>

    <!-- Playlists タブコンテンツ -->
    <div id="content-playlists" class="tab-content">
        <!-- GET /api/playlists -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-2">
                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">GET</span>
                /api/playlists
            </h3>
            <p class="text-gray-600 mb-4">全プレイリストの一覧を取得</p>
            <button onclick="getPlaylists()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                実行
            </button>
            <div id="status-playlists-index" class="mt-2"></div>
            <div id="response-playlists-index" class="mt-4 bg-gray-100 p-4 rounded overflow-auto max-h-96"></div>
        </div>

        <!-- GET /api/playlists/{id} -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-2">
                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">GET</span>
                /api/playlists/{id}
            </h3>
            <p class="text-gray-600 mb-4">特定のプレイリスト詳細を取得（動画含む）</p>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Playlist ID:</label>
                <input type="number" id="show-playlist-id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="1">
            </div>
            <button onclick="getPlaylist()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                実行
            </button>
            <div id="status-playlists-show" class="mt-2"></div>
            <div id="response-playlists-show" class="mt-4 bg-gray-100 p-4 rounded overflow-auto max-h-96"></div>
        </div>

        <!-- POST /api/playlists -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-2">
                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">POST</span>
                /api/playlists
            </h3>
            <p class="text-gray-600 mb-4">新規プレイリストを作成</p>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Title: *</label>
                <input type="text" id="create-playlist-title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="新しいプレイリスト">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                <textarea id="create-playlist-description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3" placeholder="説明文（オプション）"></textarea>
            </div>
            <button onclick="createPlaylist()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                作成
            </button>
            <div id="status-playlists-store" class="mt-2"></div>
            <div id="response-playlists-store" class="mt-4 bg-gray-100 p-4 rounded overflow-auto max-h-96"></div>
        </div>

        <!-- PUT /api/playlists/{id} -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-2">
                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm">PUT</span>
                /api/playlists/{id}
            </h3>
            <p class="text-gray-600 mb-4">プレイリストを更新</p>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Playlist ID: *</label>
                <input type="number" id="update-playlist-id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="1">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Title: *</label>
                <input type="text" id="update-playlist-title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="更新されたタイトル">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                <textarea id="update-playlist-description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3" placeholder="説明文（オプション）"></textarea>
            </div>
            <button onclick="updatePlaylist()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                更新
            </button>
            <div id="status-playlists-update" class="mt-2"></div>
            <div id="response-playlists-update" class="mt-4 bg-gray-100 p-4 rounded overflow-auto max-h-96"></div>
        </div>

        <!-- DELETE /api/playlists/{id} -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-2">
                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">DELETE</span>
                /api/playlists/{id}
            </h3>
            <p class="text-gray-600 mb-4">プレイリストを削除</p>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Playlist ID: *</label>
                <input type="number" id="delete-playlist-id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="1">
            </div>
            <button onclick="deletePlaylist()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                削除
            </button>
            <div id="status-playlists-destroy" class="mt-2"></div>
            <div id="response-playlists-destroy" class="mt-4 bg-gray-100 p-4 rounded overflow-auto max-h-96"></div>
        </div>
    </div>

    <!-- Videos タブコンテンツ -->
    <div id="content-videos" class="tab-content hidden">
        <!-- GET /api/playlists/{playlist}/videos -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-2">
                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">GET</span>
                /api/playlists/{playlist}/videos
            </h3>
            <p class="text-gray-600 mb-4">プレイリストの動画一覧を取得</p>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Playlist ID: *</label>
                <input type="number" id="videos-index-playlist-id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="1">
            </div>
            <button onclick="getVideos()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                実行
            </button>
            <div id="status-videos-index" class="mt-2"></div>
            <div id="response-videos-index" class="mt-4 bg-gray-100 p-4 rounded overflow-auto max-h-96"></div>
        </div>

        <!-- POST /api/playlists/{playlist}/videos -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-2">
                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">POST</span>
                /api/playlists/{playlist}/videos
            </h3>
            <p class="text-gray-600 mb-4">プレイリストに動画を追加</p>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Playlist ID: *</label>
                <input type="number" id="videos-store-playlist-id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="1">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">YouTube ID: *</label>
                <input type="text" id="videos-store-youtube-id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="dQw4w9WgXcQ">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Title: *</label>
                <input type="text" id="videos-store-title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="動画タイトル">
            </div>
            <button onclick="createVideo()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                追加
            </button>
            <div id="status-videos-store" class="mt-2"></div>
            <div id="response-videos-store" class="mt-4 bg-gray-100 p-4 rounded overflow-auto max-h-96"></div>
        </div>

        <!-- DELETE /api/playlists/{playlist}/videos/{video} -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-2">
                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">DELETE</span>
                /api/playlists/{playlist}/videos/{video}
            </h3>
            <p class="text-gray-600 mb-4">プレイリストから動画を削除</p>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Playlist ID: *</label>
                <input type="number" id="videos-destroy-playlist-id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="1">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Video ID: *</label>
                <input type="number" id="videos-destroy-video-id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="1">
            </div>
            <button onclick="deleteVideo()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                削除
            </button>
            <div id="status-videos-destroy" class="mt-2"></div>
            <div id="response-videos-destroy" class="mt-4 bg-gray-100 p-4 rounded overflow-auto max-h-96"></div>
        </div>
    </div>
</div>

<script>
    // タブ切り替え
    function switchTab(tabName) {
        // すべてのタブボタンを非アクティブに
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('border-blue-500', 'text-blue-600');
            btn.classList.add('border-transparent', 'text-gray-500');
        });

        // すべてのタブコンテンツを非表示に
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // 選択されたタブをアクティブに
        document.getElementById(`tab-${tabName}`).classList.remove('border-transparent', 'text-gray-500');
        document.getElementById(`tab-${tabName}`).classList.add('border-blue-500', 'text-blue-600');

        // 選択されたタブコンテンツを表示
        document.getElementById(`content-${tabName}`).classList.remove('hidden');
    }

    // レスポンス表示用のヘルパー関数
    function displayResponse(statusElement, responseElement, status, statusText, data, duration) {
        const isSuccess = status >= 200 && status < 300;
        statusElement.innerHTML = `
            <span class="text-sm ${isSuccess ? 'text-green-600' : 'text-red-600'}">
                ${status} ${statusText} (${duration}ms)
            </span>
        `;

        if (data !== null && data !== undefined && data !== '') {
            responseElement.innerHTML = `<pre><code>${JSON.stringify(data, null, 2)}</code></pre>`;
        } else {
            responseElement.innerHTML = `<pre><code>No Content (204)</code></pre>`;
        }
    }

    // エラー表示用のヘルパー関数
    function displayError(statusElement, responseElement, error) {
        statusElement.innerHTML = `<span class="text-sm text-red-600">Error</span>`;
        responseElement.innerHTML = `<pre><code>Error: ${error.message}</code></pre>`;
    }

    // ========== Playlists API Functions ==========

    // GET /api/playlists
    async function getPlaylists() {
        const statusEl = document.getElementById('status-playlists-index');
        const responseEl = document.getElementById('response-playlists-index');

        try {
            const startTime = Date.now();
            const response = await fetch('/api/playlists', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            });

            const duration = Date.now() - startTime;
            const data = await response.json();

            displayResponse(statusEl, responseEl, response.status, response.statusText, data, duration);
        } catch (error) {
            displayError(statusEl, responseEl, error);
        }
    }

    // GET /api/playlists/{id}
    async function getPlaylist() {
        const id = document.getElementById('show-playlist-id').value;
        const statusEl = document.getElementById('status-playlists-show');
        const responseEl = document.getElementById('response-playlists-show');

        if (!id) {
            alert('Playlist IDを入力してください');
            return;
        }

        try {
            const startTime = Date.now();
            const response = await fetch(`/api/playlists/${id}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            });

            const duration = Date.now() - startTime;
            const data = await response.json();

            displayResponse(statusEl, responseEl, response.status, response.statusText, data, duration);
        } catch (error) {
            displayError(statusEl, responseEl, error);
        }
    }

    // POST /api/playlists
    async function createPlaylist() {
        const title = document.getElementById('create-playlist-title').value;
        const description = document.getElementById('create-playlist-description').value;
        const statusEl = document.getElementById('status-playlists-store');
        const responseEl = document.getElementById('response-playlists-store');

        if (!title) {
            alert('Titleを入力してください');
            return;
        }

        try {
            const startTime = Date.now();
            const response = await fetch('/api/playlists', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ title, description })
            });

            const duration = Date.now() - startTime;
            const data = await response.json();

            displayResponse(statusEl, responseEl, response.status, response.statusText, data, duration);

            // 成功した場合、フォームをクリア
            if (response.status === 201) {
                document.getElementById('create-playlist-title').value = '';
                document.getElementById('create-playlist-description').value = '';
            }
        } catch (error) {
            displayError(statusEl, responseEl, error);
        }
    }

    // PUT /api/playlists/{id}
    async function updatePlaylist() {
        const id = document.getElementById('update-playlist-id').value;
        const title = document.getElementById('update-playlist-title').value;
        const description = document.getElementById('update-playlist-description').value;
        const statusEl = document.getElementById('status-playlists-update');
        const responseEl = document.getElementById('response-playlists-update');

        if (!id || !title) {
            alert('Playlist IDとTitleを入力してください');
            return;
        }

        try {
            const startTime = Date.now();
            const response = await fetch(`/api/playlists/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ title, description })
            });

            const duration = Date.now() - startTime;
            const data = await response.json();

            displayResponse(statusEl, responseEl, response.status, response.statusText, data, duration);
        } catch (error) {
            displayError(statusEl, responseEl, error);
        }
    }

    // DELETE /api/playlists/{id}
    async function deletePlaylist() {
        const id = document.getElementById('delete-playlist-id').value;
        const statusEl = document.getElementById('status-playlists-destroy');
        const responseEl = document.getElementById('response-playlists-destroy');

        if (!id) {
            alert('Playlist IDを入力してください');
            return;
        }

        if (!confirm(`プレイリスト ID ${id} を削除しますか？`)) {
            return;
        }

        try {
            const startTime = Date.now();
            const response = await fetch(`/api/playlists/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }
            });

            const duration = Date.now() - startTime;
            let data = null;

            // 204の場合、レスポンスボディはない
            if (response.status !== 204) {
                data = await response.json();
            }

            displayResponse(statusEl, responseEl, response.status, response.statusText, data, duration);

            // 成功した場合、フォームをクリア
            if (response.status === 204) {
                document.getElementById('delete-playlist-id').value = '';
            }
        } catch (error) {
            displayError(statusEl, responseEl, error);
        }
    }

    // ========== Videos API Functions ==========

    // GET /api/playlists/{playlist}/videos
    async function getVideos() {
        const playlistId = document.getElementById('videos-index-playlist-id').value;
        const statusEl = document.getElementById('status-videos-index');
        const responseEl = document.getElementById('response-videos-index');

        if (!playlistId) {
            alert('Playlist IDを入力してください');
            return;
        }

        try {
            const startTime = Date.now();
            const response = await fetch(`/api/playlists/${playlistId}/videos`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            });

            const duration = Date.now() - startTime;
            const data = await response.json();

            displayResponse(statusEl, responseEl, response.status, response.statusText, data, duration);
        } catch (error) {
            displayError(statusEl, responseEl, error);
        }
    }

    // POST /api/playlists/{playlist}/videos
    async function createVideo() {
        const playlistId = document.getElementById('videos-store-playlist-id').value;
        const youtubeId = document.getElementById('videos-store-youtube-id').value;
        const title = document.getElementById('videos-store-title').value;
        const statusEl = document.getElementById('status-videos-store');
        const responseEl = document.getElementById('response-videos-store');

        if (!playlistId || !youtubeId || !title) {
            alert('すべての項目を入力してください');
            return;
        }

        try {
            const startTime = Date.now();
            const response = await fetch(`/api/playlists/${playlistId}/videos`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ youtube_id: youtubeId, title })
            });

            const duration = Date.now() - startTime;
            const data = await response.json();

            displayResponse(statusEl, responseEl, response.status, response.statusText, data, duration);

            // 成功した場合、一部フォームをクリア
            if (response.status === 201) {
                document.getElementById('videos-store-youtube-id').value = '';
                document.getElementById('videos-store-title').value = '';
            }
        } catch (error) {
            displayError(statusEl, responseEl, error);
        }
    }

    // DELETE /api/playlists/{playlist}/videos/{video}
    async function deleteVideo() {
        const playlistId = document.getElementById('videos-destroy-playlist-id').value;
        const videoId = document.getElementById('videos-destroy-video-id').value;
        const statusEl = document.getElementById('status-videos-destroy');
        const responseEl = document.getElementById('response-videos-destroy');

        if (!playlistId || !videoId) {
            alert('Playlist IDとVideo IDを入力してください');
            return;
        }

        if (!confirm(`動画 ID ${videoId} を削除しますか？`)) {
            return;
        }

        try {
            const startTime = Date.now();
            const response = await fetch(`/api/playlists/${playlistId}/videos/${videoId}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }
            });

            const duration = Date.now() - startTime;
            let data = null;

            // 204の場合、レスポンスボディはない
            if (response.status !== 204) {
                data = await response.json();
            }

            displayResponse(statusEl, responseEl, response.status, response.statusText, data, duration);

            // 成功した場合、Video IDをクリア
            if (response.status === 204) {
                document.getElementById('videos-destroy-video-id').value = '';
            }
        } catch (error) {
            displayError(statusEl, responseEl, error);
        }
    }
</script>
@endsection
