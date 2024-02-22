<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>詳細画面</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-red-900 min-h-screen flex justify-center items-center">
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold text-yellow-200 mb-6">{{ $post->title }}</h1>
        @if($post->image_url)
            <div class="mt-4">
                <img src="{{ $post->image_url }}" alt="画像が読み込めません。" class="max-w-full h-auto">
            </div>
        @endif
        <div class="bg-red-900 rounded-lg shadow-md p-6 mb-6">
            <div class="mb-4">
                <h3 class="text-lg font-bold text-yellow-200">おすすめポイント</h3>
                <p class="text-yellow-200">{{ $post->body }}</p>
            </div>
            <h3 class="text-lg font-bold text-yellow-200">タグ</h3>
            @foreach($post->tags as $tag)
            <div class="mb-2">
                <p class="text-yellow-200">{{ $tag->tag_name }}</p>
            </div>
            @endforeach
        </div>
        <div class="flex justify-between mb-6 block text-yellow-200 text-lg font-semibold ">
            <div class="transition duration-100 hover:text-black active:text-black">
                <a href="/">戻る</a>
            </div>
            <div class="transition duration-100 hover:text-white active:bg-red-900">
                <a href="/posts/{{ $post->id }}/edit">編集</a>
            </div>
        </div>
    </div>
</body>
</html>
