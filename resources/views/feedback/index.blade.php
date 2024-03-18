<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>フィードバック一覧</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-red-900 min-h-screen flex justify-center items-center">
    <div class="container mx-auto py-8 px-4">
        <form action="{{ route('feedback.store') }}" method="POST" class="bg-red-900 rounded-lg shadow-md p-6">
            @csrf
            <div class="bg-red-900 rounded-lg shadow-md p-6 mb-6">
                <div class="mb-4">
                    @foreach($feedbacks as $feedback)
                        <div class="flex flex-col border border-yellow-200 rounded-md p-4 mb-4">
                            <p class="text-lg text-yellow-200">
                                <a href="{{ route('feedback.show', $feedback->id) }}" class="transition duration-100 hover:text-white active:text-white">{!! nl2br(e($feedback->content)) !!}</a>
                            </p>
                            <p class="text-xs text-right text-yellow-200">{{ $feedback->created_at->format('Y年m月d日')}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
                <div class="flex justify-between mb-6 block text-yellow-200 text-lg font-semibold">
                <div class="transition duration-100 hover:text-black active:text-yellow-200">
                    <a href="/">戻る</a>
                </div>
                <div class="transition duration-100 hover:text-white active:text-yellow-200">
                    <a href="{{ route('feedback.create')}}">作成</a>
                </div>
                </div>
        </form>
    </div>
</body>
</html>
