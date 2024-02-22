<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Tag;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $random_tag = Auth::user()->tags->random()->tag_name;
        //dd($a);
       
        $random_posts = Post::whereHas('tags', function ($q) use ($random_tag) {
             $q->where('tag_name', '=', $random_tag);
        })->get();
        //dd(count($random_posts));
        if(count($random_posts)>0){
            $random_post=$random_posts->random();
    
        }else{
            $random_post=NULL;
        }
        return view('posts.index')->with(['post' => $random_post, 'posts' => $post->getPaginateByLimit()]);
    }

    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }

    public function store(Post $post, PostRequest $request) // 引数をRequestからPostRequestにする
    {
        $input = $request['post'];
        $input_tags = $request->tags_array; 
        $input += ['user_id' => $request->user()->id]; 
        if($request->file('image')){
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $input += ['image_url' => $image_url];
        }
        
        $post->fill($input)->save();
        $post->tags()->attach($input_tags);
        return redirect('/posts/' . $post->id);
    }
    
   public function edit(Post $post)
{
    // 投稿に紐づいているタグ情報を取得
    $tags = Tag::all();
    $selectedTags = $post->tags()->pluck('tags.id')->toArray();
    
    if ($post->user_id !== Auth::id()) {
        return redirect()->route('index')->with('error', '自分の投稿のみ編集できます。');
    }

    // 編集画面を表示するビューに、投稿とタグ情報を渡す
    return view('posts.edit', compact('post', 'tags', 'selectedTags'));
}
    
public function update(PostRequest $request, Post $post)
{
    // ユーザーが投稿者でない場合は一覧ページにリダイレクト
    if ($post->user_id !== Auth::id()) {
        return redirect()->route('index')->with('error', '自分の投稿のみ編集できます。');
    }

    // リクエストから投稿データを取得
    $input_post = $request->input('post');

    // ユーザーに紐づいた投稿データを更新
    $post->fill($input_post)->save();

    // タグの更新
    $post->tags()->sync($request->tags_array);

    return redirect('/posts/' . $post->id);
}
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/')->with('success', '投稿が削除されました');
        
    }
    
    public function create(Tag $tag)
    {
        return view('posts.create')->with(['tags' => $tag->get()]);
    }
    
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $posts = Post::where('title', 'like', "%{$keyword}%")
            ->orWhereHas('tags', function ($query) use ($keyword) {
                $query->where('tag_name', 'like', "%{$keyword}%");
            })
            ->paginate(10);
        $posts->appends(['keyword' => $keyword])->links();
        return view('posts.search')->with(['posts' => $posts]);
    }
    
    public function like($id) {
        Like::create([
            'post_id' => $id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }

    public function unlike($id) {
        $like = Like::where('post_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();

        
        return redirect()->back();
    }
    
}
