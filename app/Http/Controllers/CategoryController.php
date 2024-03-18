<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create()
    {
        // カテゴリーの作成ビューを表示する
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // カテゴリーを保存する処理
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.create')->with('success', 'カテゴリーが作成されました。');
    }
}
