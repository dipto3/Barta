<?php

namespace App\Services;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Comment;
use Carbon\Carbon;

class CommentService{
    public function createComment($request)
    {

        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->postId,
            'comment' => $request->comment,
        ]);

    }

    public function editComment($uuid, $id)
    {
        $post = DB::table('posts')
            ->where('posts.uuid', $uuid)
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name as user_name', 'users.id as uid', 'users.userName as userName', 'users.uuid as userUuid')
            ->first();

        $comment = DB::table('comments')
            ->where('comments.id', $id)
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->select('comments.*')
            ->first();
        // dd($comment);
        return compact('post', 'comment');

    }

    public function updateComment($request,$id)
    {
        $loggedInUser = Auth::user()->id;
        $post = DB::table('comments')
        ->where('user_id',$loggedInUser)
        ->where('id', $id)
        ->update([
            'comment' => $request->comment,
            'updated_at' => Carbon::now()
        ]);
    }

    public function remove($id){
        $loggedInUser = Auth::user()->id;
        $comment = Comment::where('user_id', $loggedInUser)->where('id',$id)->delete();
    }
}
