<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisualController extends Controller
{
    public function index()
    {
        // 例として、全ての投稿を取得して $posts 変数に代入する
        $posts = Post::whereNotNull('image_url')->get()->shuffle();
        
        // $posts 変数をビューに渡す
        return view('visual', compact('posts'));
    }
}
