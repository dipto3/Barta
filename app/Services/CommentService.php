<?php

namespace App\Services;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Comment;
class CommentService{
    public function createComment($request)
    {
        // $request->validated();
        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->postId,
            'comment' => $request->comment,
        ]);

    }


    public function remove($id){
        $loggedInUser = Auth::user()->id;
        $post = Comment::where('user_id', $loggedInUser)->where('id',$id)->delete();
    }
}
