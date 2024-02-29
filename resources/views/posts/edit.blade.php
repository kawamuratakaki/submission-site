<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>おすすめ漫画投稿詳細</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-red-900 min-h-screen flex justify-center items-center">
<div class="container mx-auto py-8 px-4">
        <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data" class="bg-red-900 rounded-lg shadow-md p-6">
            @csrf
            @method('PUT')
            <div class='mb-6'>
                <label for="title" class="block text-yellow-200 text-lg font-semibold mb-2">タイトル</label>
                <input id="title" type='text' name='post[title]' value="{{ $post->title }}" class="w-full px-4 py-2 rounded-md shadow-sm bg-gray-100 text-gray-800 focus:outline-none focus:bg-white focus:ring-2 focus:ring-yellow-300">
            </div>
            <div class='mb-6'>
                <label for="body" class="block text-yellow-200 text-lg font-semibold mb-2">おすすめポイント</label>
                <textarea id="body" name='post[body]' rows="4" class="w-full px-4 py-2 rounded-md shadow-sm bg-gray-100 text-gray-800 focus:outline-none focus:bg-white focus:ring-2 focus:ring-yellow-300">{{ $post->body }}</textarea>
            </div>
            <div class='mb-6'>
                <label for="tags" class="block text-yellow-200 text-lg font-semibold mb-2">タグ</label>
                <select id="tags" name="tags_array[]" multiple class="w-full px-4 py-2 rounded-md shadow-sm bg-gray-100 text-gray-800 focus:outline-none focus:bg-white focus:ring-2 focus:ring-yellow-300">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'selected' : '' }}>{{ $tag->tag_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class='mb-6'>
        <label for="image" class="block text-yellow-200 text-lg font-semibold mb-2">現在の画像</label>
        @if($post->image_url)
            <img src="{{ $post->image_url }}" alt="現在の画像" class="mb-4 max-w-full h-auto rounded-md">
        @endif
        <input type="file" id="image" name="image" class="w-full px-4 py-2 rounded-md shadow-sm bg-gray-100 text-gray-800 focus:outline-none focus:bg-white focus:ring-2 focus:ring-yellow-300">
    </div>
            <div class="flex justify-between mb-6 block text-yellow-200 text-lg font-semibold">
                <div class="transition duration-100 hover:text-black active:text-yellow-200">
                    <a href="/posts/{{ $post->id }}">戻る</a>
                </div>
                <div class="text-yellow-200 font-bold hover:underline">
                    <input type="submit" value="保存" class="bg-red-900 px-6 py-2 rounded-md shadow-sm text-lg font-semibold text-yellow-200 hover:bg-red-900 hover:text-white cursor-pointer">
                </div>
        </form>
                <div class="transition duration-100 hover:text-red-600 active:text-yellow-200">
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="deletePost({{ $post->id }})">削除</button>
                </form>
                </div>
                
            </div>
</div>
    <script>
    function deletePost(id) {
        'use strict';
        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        }
    }
</script>
</body>
</html>
