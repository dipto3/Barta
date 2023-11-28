<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentService
{
    public function create($request)
    {
        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->postId,
            'comment' => $request->comment,
        ]);

    }

    public function edit($uuid, $id)
    {

        $post = Post::with('user')->where('uuid', $uuid)->first();
        $comment = Comment::with('post')->where('id', $id)->first();

        return compact('post', 'comment');

    }

    public function update($request, $id)
    {
        $loggedInUser = Auth::user()->id;
        $post = Comment::where('user_id', $loggedInUser)->where('id', $id)->first();
        $post->update([
            'comment' => $request->comment,
        ]);
    }

    public function remove($id)
    {
        $loggedInUser = Auth::user()->id;
        $comment = Comment::where('user_id', $loggedInUser)->where('id', $id)->delete();
    }
}