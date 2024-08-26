<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\comments;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;

class CommentsController extends Controller
{

    public function index()
    {
        //
    }

    public function store(StoreCommentRequest $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        Comment::create([
            'content' => $request->content,
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back(); 
    }

    public function destroy($id)
    {
        Comment::findorfail($id)->delete();
        return redirect()->back(); 
    }
}
