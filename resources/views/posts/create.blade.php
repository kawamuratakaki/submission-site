<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>おすすめ漫画投稿作成</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-red-900 min-h-screen flex justify-center items-center">
        <div class="container mx-auto py-8 px-4">
            <form action="/posts" method="POST" enctype="multipart/form-data" class="bg-red-900 rounded-lg shadow-md p-6">
                @csrf
                <div class="bg-red-900 mb-4">
                    <label for="title" class="text-lg font-bold text-yellow-200">タイトル</label>
                    <input type="text" id="title" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}" class="w-full border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-yellow-200">
                    <p class="text-red-500 mt-1">{{ $errors->first('post.title') }}</p>
                </div>
                <div class="mb-4">
                    <label for="body" class="text-lg font-bold text-yellow-200">おすすめポイント</label>
                    <textarea id="body" name="post[body]" placeholder="おすすめ理由" class="w-full border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-yellow-200">{{ old('post.body') }}</textarea>
                    <p class="text-red-500 mt-1">{{ $errors->first('post.body') }}</p>
                </div>
                <div class="mb-4">
                    <label for="tags" class="text-lg font-bold text-yellow-200">タグ</label>
                    <select id="tags" name="tags_array[]" multiple class="w-full border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-yellow-200">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="image" class="text-lg font-bold text-yellow-200">イメージ画像</label>
                    <input type="file" id="image" name="image" class="w-full border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-yellow-200">
                </div>
                <div class="flex justify-between mb-6 block text-yellow-200 text-lg font-semibold">
                <div class="transition duration-100 hover:text-black active:text-yellow-200">
                    <a href="/">戻る</a>
                </div>
                <div class="text-yellow-200 font-bold hover:underline">
                    <input type="submit" value="保存" class="bg-red-900 px-6 py-2 rounded-md shadow-sm text-lg font-semibold text-yellow-200 hover:bg-red-900 hover:text-white cursor-pointer">
                </div>
            </form>
        </div>
</body>
</html>
