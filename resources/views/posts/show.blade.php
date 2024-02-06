<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <x-app-layout>
        <x-slot name="header">
            Dashboard
    　　</x-slot>
    <body>
        <h1 class="title">
            {{ $post->title }}
        </h1>
        <div class="content">
            <div class="content__post">
                <h3>おすすめポイント</h3>
                <p>{{ $post->body }}</p>    
            </div>
        </div>
        
        @foreach($post->tags as $tag)
         <div>
            <h3>タグ</h3>
            {{ $tag->tag_name }}
        </div>
        @endforeach
        @if($post->image_url)
        <div>
            <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
        </div>
        @endif
        <div class="edit"><a href="/posts/{{ $post->id }}/edit">編集</a></div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>
