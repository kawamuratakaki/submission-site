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
    <div>
            <div class="bg-red-900 py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <div class="mb-10 md:mb-16">
            <button type="submit" class="bg-red-900 px-6 py-2 rounded-md shadow-sm text-lg font-semibold text-yellow-200 hover:bg-white hover:text-black cursor-pointer">
                <a href="/">戻る</a>
            </button>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4">

        @if($histories->count() > 0)
                @foreach($histories as $history)
                    @if ($history->post)
                        <div class='flex flex-col overflow-hidden rounded-lg border bg-red-900 mx-auto max-w-2xl w-full'>
                            <a href="/posts/{{ $history->post->id }}" class="group relative block overflow-hidden bg-gray-100">
                                @if($history->post->image_url)
                                    <div style="padding-top: 100%; position: relative;">
                                        <img src="{{ $history->post->image_url }}" alt="画像が読み込めません。" class="absolute inset-0 w-full h-full object-cover">
                                    </div>
                                @endif
                            </a>

                            <div class="flex flex-1 flex-col p-4 sm:p-6">
                                <h2 class="mb-2 text-lg font-semibold text-yellow-200">
                                    <a href="/posts/{{ $history->post->id }}" class="transition duration-100 hover:text-white active:text-white">{{ $history->post->title }}</a>
                                </h2>
                                <p class="mb-8 text-yellow-200">{{ $history->post->body }}</p>

                                <div class="mt-auto flex items-end justify-between">
                                    <!-- カテゴリーやタグの情報を追加 -->
                                    <div class="flex flex-col gap-2">
                                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                            <h2 class="text-sm font-bold text-yellow-200">タグ</h2>
                                            @foreach($history->post->tags as $tag)
                                                <div>{{ $tag->tag_name }}</div>
                                            @endforeach
                                        </span>
                                        <div class="flex items-center gap-2">
                                            <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                                <h2 class="text-sm font-bold text-yellow-200">ユーザー名</h2>
                                                <div class="flex items-center gap-2">
                                                    @if ($history->post->user->profile_photo_path)
                                                        <img src="{{ $history->post->user->profile_photo_path }}" class="w-8 h-8 rounded-full">
                                                    @endif
                                                    <div>{{ $history->post->user->name }}</div>
                                                </div>
                                                <h2 class="text-sm font-bold text-yellow-200">作成日</h2>
                                                <p>{{ $history->post->created_at->format('Y年m月d日') }}</p>
                                            </span>
                                        </div>
                                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                            @auth
                                                @if ($history->post->isLikedBy(Auth::user()))
                                                    <a href="{{ route('unlike', ['id' => $history->post->id]) }}" class="btn btn-danger">いいね</a>
                                                @else
                                                    <a href="{{ route('like', ['id' => $history->post->id]) }}" class="btn btn-primary">普通</a>
                                                @endif
                                            @endauth
                                        </span>
                                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                            <p>{{ $history->post->likes->count() }}いいね数</p>
                                        </span>
                                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                            <button class="share-button" data-share-url="{{ url(route('share', $history->post->id)) }}">シェア</button>
                                        </span>
                                        @if(auth()->check() && auth()->user()->id === $history->user_id)
                                            <form action="{{ route('histories.destroy', $history->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <h2 class="text-sm font-bold text-yellow-200">
                                            <button type="submit" onclick="return confirm('本当に削除しますか？')"class="transition duration-100 hover:text-white active:text-black">履歴削除</button>
                                            </h2>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            </div>
            </div>
            </div>


        @endif
        </div>
    </div>
</body>
</html>
