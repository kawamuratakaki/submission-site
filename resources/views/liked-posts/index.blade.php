<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>おすすめ漫画投稿サイト</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-red-900 py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <div class="mb-10 md:mb-16">
                <button type="submit" class="bg-red-900 px-6 py-2 rounded-md shadow-sm text-lg font-semibold text-yellow-200 hover:bg-white hover:text-black cursor-pointer">
                    <a href="/">戻る</a>
                </button>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4">
                    <!-- ここに記事のループを追加 -->
                    @foreach ($likedPosts as $like)
                        @if ($like->post)
                            <div class='flex flex-col overflow-hidden rounded-lg border bg-red-900 mx-auto max-w-2xl w-full'>
                                <a href="/posts/{{ $like->post->id }}" class="group relative block overflow-hidden bg-gray-100">
                                    @if($like->post->image_url)
                                        <div style="padding-top: 100%; position: relative;">
                                            <img src="{{ $like->post->image_url }}" alt="画像が読み込めません。" class="absolute inset-0 w-full h-full object-cover">
                                        </div>
                                    @endif
                                </a>

                                <div class="flex flex-1 flex-col p-4 sm:p-6">
                                    <h2 class="mb-2 text-lg font-semibold text-yellow-200">
                                        <a href="/posts/{{ $like->post->id }}" class="transition duration-100 hover:text-white active:text-white">{{ $like->post->title }}</a>
                                    </h2>
                                    <p class="mb-8 text-yellow-200">{{ $like->post->body }}</p>

                                    <div class="mt-auto flex items-end justify-between">
                                        <!-- カテゴリーやタグの情報を追加 -->
                                        <div class="flex flex-col gap-2">
                                            <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                                <h2 class="text-sm font-bold text-yellow-200">タグ</h2>
                                                @foreach($like->post->tags as $tag)
                                                    <div>{{ $tag->tag_name }}</div>
                                                @endforeach
                                            </span>
                                            <div class="flex items-center gap-2">
                                                <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                                    <h2 class="text-sm font-bold text-yellow-200">ユーザー名</h2>
                                                    <div class="flex items-center gap-2">
                                                        @if ($like->post->user->profile_photo_path)
                                                            <img src="{{ $like->post->user->profile_photo_path }}" class="w-8 h-8 rounded-full">
                                                        @endif
                                                        <div>{{ $like->post->user->name }}</div>
                                                    </div>
                                                </span>
                                                <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                                    <h2 class="text-sm font-bold text-yellow-200">作成日</h2>
                                                    <p>{{ $like->post->created_at->format('Y年m月d日') }}</p>
                                                </span>
                                            </div>
                                        </div>
                                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                            @auth
                                                @if ($like->post->isLikedBy(Auth::user()))
                                                    <a href="{{ route('unlike', ['id' => $like->post->id]) }}" class="btn btn-danger">いいね</a>
                                                @else
                                                    <a href="{{ route('like', ['id' => $like->post->id]) }}" class="btn btn-primary">普通</a>
                                                @endif
                                            @endauth
                                        </span>
                                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                            <p>{{ $like->post->likes->count() }}いいね数</p>
                                        </span>
                                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                            @auth
                                                @if ($like->read_status)
                                                    <a href="{{ route('toggleReadStatus', ['id' => $like->post->id]) }}" class="btn btn-info">読んだ</a>
                                                @else
                                                    <a href="{{ route('toggleReadStatus', ['id' => $like->post->id]) }}" class="btn btn-success">読みたい</a>
                                                @endif
                                            @endauth
                                        </span>
                                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                            <button class="share-button" data-share-url="{{ url(route('share', $like->post->id)) }}">シェア</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var shareButtons = document.querySelectorAll('.share-button');

            shareButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // ボタンに付加されたdata-share-url属性からシェアURLを取得
                    var shareUrl = button.getAttribute('data-share-url');

                    // コピー関数を呼び出す
                    copyToClipboard(shareUrl);
                });
            });

            function copyToClipboard(text) {
                var textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();

                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'コピーに成功しました！' : 'コピーに失敗しました。手動でコピーしてください。';
                    alert(msg);
                } catch (err) {
                    console.error('コピーに失敗しました。', err);
                }

                document.body.removeChild(textarea);
            }
        });
    </script>
</body>
</html>
