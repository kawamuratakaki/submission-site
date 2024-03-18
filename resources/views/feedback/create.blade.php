<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>フィードバック作成</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-red-900 min-h-screen flex justify-center items-center">
    <div class="container mx-auto py-8 px-4">
        <form action="{{ route('feedback.store') }}" method="POST" class="bg-red-900 rounded-lg shadow-md p-6">
            @csrf
            <div class="bg-red-900 mb-4">
                <label for="content" class="text-lg font-bold text-yellow-200">フィードバック</label>
                <textarea id="content" name="content" placeholder="フィードバック" class="w-full border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-yellow-200">{{ old('content') }}</textarea>
                <p class="text-red-500 mt-1">{{ $errors->first('content') }}</p>
            </div>
            <div class="flex justify-between mb-6 block text-yellow-200 text-lg font-semibold">
                <div class="transition duration-100 hover:text-black active:text-yellow-200">
                    <a href="{{ route('feedback.index') }}">戻る</a>
                </div>
                <div class="text-yellow-200 font-bold hover:underline">
                    <input type="submit" value="保存" class="bg-red-900 px-6 py-2 rounded-md shadow-sm text-lg font-semibold text-yellow-200 hover:bg-red-900 hover:text-white cursor-pointer">
                </div>
        </form>
    </div>
</body>

</html>
