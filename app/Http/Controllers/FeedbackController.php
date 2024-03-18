<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
//以下追記
{
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->get(); // または適切なデータ取得方法を使用
        return view('feedback.index', compact('feedbacks')); // 最新のフィードバックから取得
    }
    public function create()   //コンタクトフォームを表示
    {
        return view('feedback.create');
    }
    
    public function store(Request $request)
{
    // バリデーションのルールを定義
    $request->validate([
        'content' => 'required|string',
    ]);

    // Feedback モデルを使用してフィードバックを作成
    $feedback = Feedback::create([
        'content' => $request->input('content'), // フォームからのメッセージを取得
    ]);

    // 保存が成功したら成功メッセージをセットしてリダイレクト
    return redirect()->route('feedback.index')->with('success', 'フィードバックを受け付けました。');
}

public function show($id)
{
    $feedback = Feedback::findOrFail($id);
    return view('feedback.show', compact('feedback'));
}

}