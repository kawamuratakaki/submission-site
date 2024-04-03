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
        <div class="bg-red-900 rounded-lg shadow-md p-6 mb-6">
            <div class="mb-4">
        <div class="flex justify-between mb-6 block text-yellow-200 text-lg font-semibold">
        <div class="transition duration-100 hover:text-black active:text-yellow-200">
            <a href="/">戻る</a>
        </div>
        <button type="submit" class="bg-red-900 px-6 py-2 rounded-md shadow-sm text-lg font-semibold text-yellow-200 hover:bg-red-700 hover:text-white cursor-pointer">
            <a href="{{ route('questions.create')}}">作成</a>
        </button>
        </div>
                @foreach($questions as $question)
                    <div class="flex flex-col border border-yellow-200 rounded-md p-4 mb-4">
                        <p class="text-xl text-yellow-200">{{ $question->title }}</p>
                        <p class="text-lg text-yellow-200">{{ $question->body }}</p>
                        <p class="text-xs text-yellow-200">投稿者: {{ $question->user->name }}</p>
                        <p class="text-xs text-right text-yellow-200">{{ $question->created_at->format('Y年m月d日')}}</p>
                    </div>
                        <!-- 質問ごとの回答一覧 -->
                        @foreach($question->answers as $answer)
                            <div class="flex flex-col border border-yellow-200 rounded-md p-4 mb-4">
                                <p class="text-lg text-yellow-200">{!! nl2br(e($answer->content)) !!}</p>
                                <p class="text-xs text-right text-yellow-200">{{ $answer->created_at->format('Y年m月d日')}}</p>
                            </div>
                        @endforeach
                    <!-- 回答フォーム -->
                    <form action="{{ route('questions.storeAnswer', ['questionId' => $question->id]) }}" method="post" onsubmit="return confirmAnswerSubmission()">
                        @csrf
                        <div class="mb-2">
                            <label for="content" class="text-lg font-bold text-yellow-200">回答</label>
                            <textarea id="content" name="content" placeholder="回答内容" class="w-full border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-yellow-200">{{ old('content') }}</textarea>
                            <p class="text-red-500 mt-1">{{ $errors->first('content') }}</p>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">回答する</button>
                    </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
    function confirmAnswerSubmission() {
    'use strict';
    return confirm('編集と削除ができませんが投稿しますか？');
    }
    </script>
</body>
</html>
