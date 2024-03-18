<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- resources/views/post_images.blade.php -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>おすすめ漫画投稿・紹介サイト</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-red-900">
    <button type="submit" class="bg-red-900 px-6 py-2 rounded-md shadow-sm text-lg font-semibold text-yellow-200 hover:bg-white hover:text-black cursor-pointer">
                <a href="/">戻る</a>
            </button>
    <div class="p-6 sm:py-8 lg:py-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                @foreach ($posts as $post)
                <div class="border border-yellow-200 rounded-md">
                    <a href="/posts/{{ $post->id }}">
                        @if ($post->image_url)
                        <img src="{{ $post->image_url }}" class="w-full h-full object-cover rounded-md" alt="Post Image">
                        @endif
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
