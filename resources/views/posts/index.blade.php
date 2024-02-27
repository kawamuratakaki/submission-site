<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>おすすめ漫画投稿サイト</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>

        <x-app-layout>
        <body>
            
            <div class="bg-red-900 py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <div class="mb-10 md:mb-16">
                <div class="mb-4 text-center text-5xl font-bold text-black md:mb-6 lg:text-3xl">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <label for="default-search" class="sr-only">検索</label>
                    <div class="flex items-center">
                        <svg class="absolute inset-y-0 left-0 w-4 h-4 text-yellow-200 pointer-events-none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <input type="search" id="default-search" name="keyword" class="block w-full p-4 pl-10 text-sm text-black border border-white rounded-lg bg-gray-50 focus:ring-yellow-200 focus:border-yellow-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-yellow-200 dark:focus:ring-yellow-200 dark:focus:border-yellow-200" placeholder="タイトル検索" required>
                        <button type="submit" class="absolute bottom-2.5 right-2.5 bg-red-900 text-yellow-200 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-900 dark:hover:bg-red-900 dark:focus:ring-red-900">検索</button>
                    </div>
                </form>
            </div>
            @if(session('error'))
                <div class="bg-black text-white p-4">
                    {{ session('error') }}
                </div>
            @endif

                <h2 class="mb-4 text-center text-5xl font-bold text-yellow-200 md:mb-6 lg:text-3xl">マイタグ</h2>
                <div class="flex flex-wrap justify-center">
            @foreach(Auth::user()->tags as $tag)
                <div class="border rounded-md mb-4 text-center text-2xl font-bold text-yellow-200 md:mb-6 lg:text-2xl">{{ $tag->tag_name }}</div>
            @endforeach
                </h2>
                </div>
            <h2 class="mb-4 text-center text-5xl font-bold text-yellow-200 md:mb-6 lg:text-3xl">おすすめ漫画</h2>
            @if(isset($post))
        <div class='flex flex-col overflow-hidden rounded-lg border bg-red-900 mx-auto' style="max-width: 300px;">
        <a href="/posts/{{ $post->id }}" class="group relative block overflow-hidden bg-gray-100">
            @if($post->image_url)
                <div style="padding-top: 100%; position: relative;">
                    <img src="{{ $post->image_url }}" alt="画像が読み込めません。" class="absolute inset-0 w-full h-full object-cover">
                </div>
            @endif
        </a>
                <div class="flex flex-1 flex-col p-4 sm:p-6">
                    <h2 class="mb-2 text-lg font-semibold text-yellow-200">
                        <a href="/posts/{{ $post->id }}" class="transition duration-100 hover:text-white active:text-white">{{ $post->title }}</a>
                    </h2>
                    <p class="mb-8 text-yellow-200">{{ $post->body }}</p>
    
                        <!-- カテゴリーやタグの情報を追加 -->
                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                            <h2 class="text-sm font-bold text-yellow-200">タグ</h2>
                            @foreach($post->tags as $tag)
                            <div>{{ $tag->tag_name }}</div>
                            @endforeach
                        </span>
                        
                        <div class="flex items-center gap-2">
                            <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                            <h2 class="text-sm font-bold text-yellow-200">ユーザー名</h2>
                            <div class="flex items-center gap-2">
                                @if ($post->user->profile_photo_path)
                                    <img src="{{ asset('storage/' . $post->user->profile_photo_path) }}" class="w-8 h-8 rounded-full">
                                @endif
                                <div>{{ $post->user->name }}</div>
                            </div>
                            <h2 class="text-sm font-bold text-yellow-200">作成日</h2>
                                <p>{{ $post->created_at->format('Y年m月d日') }}</p>
                                @if($post->edited_at)
                                    <p>編集済み：{{ \Carbon\Carbon::parse($post->edited_at)->isoFormat('YYYY年MM月DD日') }}</p>
                                @endif
                            </span>
                        </div>
                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                    @auth
                        @if ($post->isLikedBy(Auth::user()))
                            <a href="{{ route('unlike', ['id' => $post->id]) }}" class="btn btn-danger">いいね</a>
                        @else
                            <a href="{{ route('like', ['id' => $post->id]) }}" class="btn btn-primary">普通</a>
                        @endif
                    @endauth
                        </span>
                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                    <p>{{ $post->likes->count() }}いいね数</p>
                        </span>
                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                    <button class="share-button" data-share-url="{{ url(route('share', $post->id)) }}">シェア</button>
                        </span>
                    
                </div>
            </div>

            <div class='paginate'>
                {{ $posts->links() }}
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
                </div>
            @else
                <h2 class="mb-4 text-center text-5xl font-bold text-yellow-200 md:mb-6 lg:text-3xl">見つかりません。</h2>
            @endif
            @auth
                <h2 class="mb-4 text-center text-5xl font-bold text-yellow-200 md:mb-6 lg:text-3xl">
                <a href="{{ route('liked-posts') }}" class="transition duration-100 hover:text-white active:text-white">いいねした投稿</a>
                </h2>
            @endauth
            
                            <h2 class="mb-4 text-center text-5xl font-bold text-yellow-200 md:mb-6 lg:text-3xl">
                                
            <a href='/posts/create' class="transition duration-100 hover:text-white active:text-white">投稿作成</a>
            </h2>
            <div class="border-t border-yellow-200"></div>

            <div class='grid gap-4 sm:grid-cols-2 md:gap-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-8'>
                <!-- ここに記事のループを追加 -->

            @foreach ($posts as $post)
    <div class='flex flex-col overflow-hidden rounded-lg border bg-red-900'>
        <a href="/posts/{{ $post->id }}" class="group relative block overflow-hidden bg-gray-100">
            @if($post->image_url)
                <div style="padding-top: 100%; position: relative;">
                    <img src="{{ $post->image_url }}" alt="画像が読み込めません。" class="absolute inset-0 w-full h-full object-cover">
                </div>
            @endif
        </a>
                
            
                <div class="flex flex-1 flex-col p-4 sm:p-6">
                    <h2 class="mb-2 text-lg font-semibold text-yellow-200">
                        <a href="/posts/{{ $post->id }}" class="transition duration-100 hover:text-white active:text-white">{{ $post->title }}</a>
                    </h2>
                    <p class="mb-8 text-yellow-200">{{ $post->body }}</p>
    
                        <!-- カテゴリーやタグの情報を追加 -->
                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                            <h2 class="text-sm font-bold text-yellow-200">タグ</h2>
                            @foreach($post->tags as $tag)
                            <div>{{ $tag->tag_name }}</div>
                            @endforeach
                        </span>
                        
                        <div class="flex items-center gap-2">
                            <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                            <h2 class="text-sm font-bold text-yellow-200">ユーザー名</h2>
                            <div class="flex items-center gap-2">
                                @if ($post->user->profile_photo_path)
                                    <img src="{{ asset('storage/' . $post->user->profile_photo_path) }}" class="w-8 h-8 rounded-full">
                                @endif
                                <div>{{ $post->user->name }}</div>
                            </div>
                            <h2 class="text-sm font-bold text-yellow-200">作成日</h2>
                                <p>{{ $post->created_at->format('Y年m月d日') }}</p>
                                @if($post->edited_at)
                                    <p>編集済み：{{ \Carbon\Carbon::parse($post->edited_at)->isoFormat('YYYY年MM月DD日') }}</p>
                                @endif
                            </span>
                        </div>
                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                    @auth
                        @if ($post->isLikedBy(Auth::user()))
                            <a href="{{ route('unlike', ['id' => $post->id]) }}" class="btn btn-danger">いいね</a>
                        @else
                            <a href="{{ route('like', ['id' => $post->id]) }}" class="btn btn-primary">普通</a>
                        @endif
                    @endauth
                        </span>
                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                    <p>{{ $post->likes->count() }}いいね数</p>
                        </span>
                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                    <button class="share-button" data-share-url="{{ url(route('share', $post->id)) }}">シェア</button>
                        </span>
                    
                </div>
            </div>
            @endforeach

            <div class='paginate'>
                {{ $posts->links() }}
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
        </x-app-layout>
    </div>
        </body>
</html>
