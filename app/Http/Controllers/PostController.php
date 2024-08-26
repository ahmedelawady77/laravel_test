<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
       $posts = Post::all();
       return view('posts.index',compact('posts')); 
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest  $request)
    {
        Post::create([
            'title'=> $request->title ,
            'content'=> $request->content ,
            'user_id' => Auth::id()
        ]);
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::findorfail($id); 
        return view ('posts.edit', compact('post'));
    }

    public function update(Request $request,$id)
    {
        $post = Post::findorfail($id);
        $post->update([
            'title'=>$request->title ,
            'content'=> $request->content ,
        ]);
        return redirect()->route('posts.index');

    }

    public function destroy($id)
    {
        Post::findorfail($id)->delete();
        return redirect()->route('posts.index');
    }
}
