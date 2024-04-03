<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>おすすめ漫画投稿・紹介サイト</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-red-900 min-h-screen flex justify-center items-center">
    <div class="container mx-auto py-8 px-4">
        <form action="{{ route('questions.store') }}" method="post" onsubmit="return confirmQuestionSubmission()" class="bg-red-900 rounded-lg shadow-md p-6">
            @csrf
            <div class="mb-4">
                <label for="title" class="text-xl font-bold text-yellow-200">質問タイトル</label>
                <textarea id="title" name="title" placeholder="質問タイトル" class="w-full border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-yellow-200">{{ old('title') }}</textarea>
                <label for="body" class="text-lg font-bold text-yellow-200 mt-2">質問内容</label>
                <textarea id="body" name="body" placeholder="質問内容" class="w-full border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-yellow-200">{{ old('body') }}</textarea>
            </div>

            <div class="flex justify-between mb-6 block text-yellow-200 text-lg font-semibold">
                <div class="transition duration-100 hover:text-black active:text-yellow-200">
                    <a href="{{ route('questions.index') }}">戻る</a>
                </div>
                <button type="submit" class="bg-red-900 px-6 py-2 rounded-md shadow-sm text-lg font-semibold text-yellow-200 hover:bg-red-700 hover:text-white cursor-pointer">質問する</button>
            </div>
        </form>
    </div>
    <script>
    function confirmQuestionSubmission() {
    'use strict';
    return confirm('編集と削除ができませんが投稿しますか？');
    }
    </script>
</body>
</html>
