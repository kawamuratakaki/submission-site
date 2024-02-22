<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>おすすめ漫画投稿サイト</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>

<x-app-layout>
<body>
    <div class="bg-red-900 py-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <div class="mb-10 md:mb-16">

                <div class='grid gap-4 sm:grid-cols-2 md:gap-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-8'>
                    <!-- ここに記事のループを追加 -->
                    @foreach ($liked as $post)
                        <div class='flex flex-col overflow-hidden rounded-lg border bg-red-900'>
                            <a href="/posts/{{ $post->id }}" class="group relative block h-48 overflow-hidden bg-gray-100 md:h-64">
                                @if($post->image_url)
                                    <div>
                                        <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
                                    </div>
                                @endif
                            </a>
                    
                            <div class="flex flex-1 flex-col p-4 sm:p-6">
                                <h2 class="mb-2 text-lg font-semibold text-yellow-200">
                                    <a href="/posts/{{ $post->id }}" class="transition duration-100 hover:text-white active:text-white">{{ $post->title }}</a>
                                </h2>
                                <p class="mb-8 text-yellow-200">{{ $post->body }}</p>
                    
                                <div class="mt-auto flex items-end justify-between">
                                    <!-- カテゴリーやタグの情報を追加 -->
                                    <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                        @foreach($post->tags as $tag)
                                            <div>{{ $tag->tag_name }}</div>
                                        @endforeach
                                    </span>
                                    
                                    <div class="flex items-center gap-2">
                                        <span class="rounded border px-2 py-1 text-sm text-yellow-200">
                                            <div>{{ $post->user->name }}</div>
                                            <p>{{ $post->created_at->format('Y年m月d日') }}</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="transition duration-100 hover:text-black active:text-yellow-200">
                    <a href="/">戻る</a>
                </div>
                <div class='paginate'>
                    {{ $liked->links() }}
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
</html>
