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
        
        <div class="bg-red-900 rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-3xl font-bold text-yellow-200 mb-6">{{ $post->title }}</h1>
            @if($post->image_url)
                <div class="mt-4">
                    <img src="{{ $post->image_url }}" alt="画像が読み込めません。" class="w-64 h-64 object-cover">
                </div>
            @endif
            <div class="mb-4">
                <h3 class="text-lg font-bold text-yellow-200">おすすめポイント</h3>
                <p class="text-yellow-200">{!! nl2br(e($post->body)) !!}</p>
            </div>
            <h3 class="text-lg font-bold text-yellow-200">タグ</h3>
            @foreach($post->tags as $tag)
            <div class="mb-2">
                <p class="text-yellow-200">{{ $tag->tag_name }}</p>
            </div>
            @endforeach
            <div class="flex items-center gap-2">
                @if ($post->user->profile_photo_path)
                    <img src="{{ $post->user->profile_photo_path }}" class="w-8 h-8 rounded-full">
                @endif
                <div class="text-yellow-200">{{ $post->user->name }}</div>
            </div>
            <h2 class="text-sm font-bold text-yellow-200">作成日</h2>
            <p class="text-yellow-200">{{ $post->created_at->format('Y年m月d日') }}</p>
            @if($post->edited_at)
                <p class="text-yellow-200">編集済み：{{ \Carbon\Carbon::parse($post->edited_at)->isoFormat('YYYY年MM月DD日') }}</p>
            @endif
        </div>
        @foreach ($post->comments as $comment)
        <div class="relative flex items-center border border-yellow-200 rounded-md p-4 mb-4">
            @if ($comment->user->profile_photo_path)
                <img src="{{ $comment->user->profile_photo_path }}" class="w-8 h-8 rounded-full mr-2">
            @endif
            <p class="text-sm font-bold text-yellow-200">
                {{ $comment->user->name }}: {{ $comment->content }}
            </p>
            @if(auth()->check() && $comment->user_id == auth()->user()->id)
                <!-- ユーザーがログインしており、コメントをしたユーザーが現在のユーザーと一致する場合 -->
                <a href="#" class="edit-link absolute right-0 bottom-0 p-2 text-yellow-200 font-semibold transition duration-100 hover:text-white" data-comment-id="{{ $comment->id }}">編集</a>
                <div class="edit-form hidden absolute right-0 bottom-0 p-2" id="edit-form-{{ $comment->id }}">
                    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <textarea id="content" name="content" placeholder="コメント内容" class="w-full border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-yellow-200">{{ $comment->content }}</textarea>
                        <p class="text-red-500 mt-1">{{ $errors->first('content') }}</p>
                        <div class="flex items-center justify-between mt-2">
                            <button type="submit" class="bg-red-900 px-6 py-2 rounded-md shadow-sm text-lg font-semibold text-yellow-200 hover:bg-red-700 hover:text-white cursor-pointer">保存</button>
                            <form id="delete-form-{{ $comment->id }}" action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="deleteComment({{ $comment->id }})" class="bg-red-900 px-6 py-2 rounded-md shadow-sm text-lg font-semibold text-yellow-200 hover:bg-red-700 hover:text-white cursor-pointer ml-2">削除</button>
                            </form>
                        </div>
                    </form>
                </div>
            @endif
        </div>
        @endforeach

        @auth
            <form action="{{ route('comments.store', ['id' => $post->id]) }}" method="post">
                @csrf
                <textarea id="content" name="content" placeholder="コメント内容" class="w-full border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:border-yellow-200">{{ old('content') }}</textarea>
                <p class="text-red-500 mt-1">{{ $errors->first('content') }}</p>
                <button type="submit" class="bg-red-900 px-6 py-2 rounded-md shadow-sm text-lg font-semibold text-yellow-200 hover:bg-red-700 hover:text-white cursor-pointer">コメントする</button>
            </form>
        @endauth

        <div class="flex justify-between mb-6 block text-yellow-200 text-lg font-semibold ">
            <div class="transition duration-100 hover:text-black active:text-black">
                <a href="/">戻る</a>
            </div>
            <div class="transition duration-100 hover:text-white active:bg-red-900">
                <a href="/posts/{{ $post->id }}/edit">編集</a>
            </div>
        </div>

    </div>

    <script>
        function deleteComment(id) {
            'use strict';
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            const editLinks = document.querySelectorAll('.edit-link');
            editLinks.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    const commentId = link.getAttribute('data-comment-id');
                    const editForm = document.getElementById(`edit-form-${commentId}`);
                    editForm.classList.toggle('hidden');
                });
            });
        });
    </script>
</body>
</html>
