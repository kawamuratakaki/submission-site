<?php

// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }
    
    public function update(Request $request, $id)
{
    $request->validate([
        'content' => 'required',
    ]);

    $comment = Comment::findOrFail($id);

    // ログインしているユーザーとコメントをしたユーザーが一致するか確認
    if(auth()->check() && $comment->user_id == auth()->user()->id) {
        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'コメントが更新されました。');
    } else {
        return redirect()->back()->with('error', '編集権限がありません。');
    }
}

public function destroy($comment_id)
{
    $comment = Comment::find($comment_id);

    if (!$comment) {
        return redirect()->back()->with('error', 'コメントが見つかりませんでした。');
    }

    $comment->delete();

    return redirect()->back()->with('success', 'コメントが削除されました。');
}
}


