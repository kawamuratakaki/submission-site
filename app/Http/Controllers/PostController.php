<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Tag;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('posts.edit')->with(['post' => $post]);
        
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $input_post += ['user_id' => $request->user()->id]; 
        $post->fill($input_post)->save();
        
        return redirect('/posts/' . $post->id);
        
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
        
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


}