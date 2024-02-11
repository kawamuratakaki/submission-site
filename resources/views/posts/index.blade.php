<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>おすすめ漫画投稿サイト</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
        <x-slot name="header">
            Dashboard
    　　</x-slot>
    <body>
        <h1 class="text-green-500 text-5xl">マイタグ</h1>
        @foreach(Auth::user()->tags as $tag)
            <div>
                {{ $tag->tag_name }}
            </div>
        @endforeach

　　　　<h1 class="bg-indigo-600">おすすめ漫画</h1>
        @if(isset($post))
        <div class="post">
            <h2>{{ $post->title }}</h2>
        </div>
        @else
            <p>漫画が見つかりません。</p>
        @endif
            
        <a href='/posts/create'>作成</a>
        <div>
            <form action="{{ route('search') }}" method="GET">

            @csrf

                <input type="text" name="keyword">
                <input type="submit" value="検索">
            </form>
        </div>
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    @foreach($post->tags as $tag)
                        <div>
                            {{ $tag->tag_name }}
                        </div>
                    @endforeach
                    <p class='body'>{{ $post->body }}</p>
                            @if($post->image_url)
                                <div>
                                    <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
                                </div>
                            @endif
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">削除</button> 
                    </form>
                </div>
            @endforeach
            ログイン：{{ Auth::user()->name }}
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        <script>
            function deletePost(id) {
                'use strict'

                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
    </x-app-layout>
</html>