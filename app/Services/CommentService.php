<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentService
{
    public function createComment($request)
    {
        $comment = DB::table('comments')->insert([
            'user_id' => Auth::user()->id,
            'post_id' => $request->postId,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
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

    public function updateComment($request, $id)
    {
        $loggedInUser = Auth::user()->id;
        $post = DB::table('comments')
            ->where('user_id', $loggedInUser)
            ->where('id', $id)
            ->update([
                'comment' => $request->comment,
                'updated_at' => Carbon::now(),
            ]);
    }

    public function remove($id)
    {
        $loggedInUser = Auth::user()->id;
        $comment = DB::table('comments')->where('user_id', $loggedInUser)->where('id', $id)->delete();
    }
}
