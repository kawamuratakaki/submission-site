<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>おすすめ漫画投稿サイト</title>
    </head>
    <x-app-layout>
        <x-slot name="header">
            Dashboard
    　　</x-slot>
    <body>
        <h1>作成画面</h1>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>タイトル</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>おすすめポイント</h2>
                <textarea name="post[body]" placeholder="おすすめ理由">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="category">
                <h2>タグ</h2>
                <select name="tags_array[]" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="image">
                <h2>イメージ画像</h2>
                <input type="file" name="image">
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">戻る</a>]</div>
    </body>
    </x-app-layout>
</html>