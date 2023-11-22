<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostService
{
    public function createPost($request)
    {

        $post = DB::table('posts')->insert([
            'user_id' => Auth::user()->id,
            'uuid' => Str::uuid()->toString(),
            'total_views' => 1,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);

    }

    public function updatePost($request, $uuid)
    {
        $loggedInUser = Auth::user()->id;
        $post = DB::table('posts')
            ->where('uuid', $uuid)
            ->update([
                'description' => $request->description,
                'updated_at' => Carbon::now(),
            ]);
    }

    public function singlePost($uuid)
    {
        $post = DB::table('posts')->where('uuid', $uuid)->increment('total_views', 1);
        $post = DB::table('posts')
            ->where('posts.uuid', $uuid)
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name as user_name', 'users.id as uid', 'users.userName as userName', 'users.uuid as userUuid')
            ->first();

        $allComments = DB::table('users')
            ->where('comments.post_id', $post->id)
            ->join('comments', 'users.id', '=', 'comments.user_id')
            ->select('users.name as user_name', 'users.id as uid', 'users.userName as userName', 'users.uuid as userUuid', 'comment', 'comments.id as commentId', 'comments.user_id as commentuId', 'comments.created_at as commentCreatedAt')
            ->orderBy('comments.id', 'DESC')
            ->get();
        // dd($allpost);

        $totalComment = DB::table('comments')->where('post_id', $post->id)->count();
        return compact('post', 'allComments', 'totalComment');
    }

    public function editPost($uuid)
    {
        $post = DB::table('posts')
            ->where('uuid', $uuid)
            ->first();
        return compact('post');

    }

    public function remove($id)
    {
        $loggedInUser = Auth::user()->id;
        $post = DB::table('posts')->where('user_id', $loggedInUser)->where('id', $id)->delete();
    }
}
