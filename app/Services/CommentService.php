<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\PostComment;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function create($request)
    {
        $user = Auth::user()->id;
        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->postId,
            'comment' => $request->comment,
        ]);
        $post = Post::find($request->postId); // Assuming postId is the ID of the post
        $post->user->notify(new PostComment($user, $comment,$post));
        return $comment;
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
        $comment = Comment::find($id);
        $postId = $comment->post->id;

        $comment->delete();

      
        auth()->user()->notifications()
            ->where('type', 'App\Notifications\PostComment')
            ->where('data->comment->user_id',$loggedInUser)
            ->where('data->comment->post_id', $postId)
            ->delete();
    }
}
