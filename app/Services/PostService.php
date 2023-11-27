<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostService
{
    public function createPost($request)
    {
        $post = Post::create([
            'user_id' => Auth::user()->id,
            'uuid' => Str::uuid()->toString(),
            'total_views' => 1,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection();
        }
    }

    public function updatePost($request, $uuid)
    {

        $post = Post::where('uuid', $uuid)->first();
        $post->update([
            'description' => $request->description,
        ]);
        if ($request->hasFile('image')) {
            $post->clearMediaCollection();
            $post->addMediaFromRequest('image')->toMediaCollection();
        }
    }

    public function singlePost($uuid)
    {
        $post = DB::table('posts')->where('uuid', $uuid)->increment('total_views', 1);
        $post = Post::with('user')->where('uuid', $uuid)->first();
        $allComments = Comment::with('user')->where('post_id', $post->id)->orderBy('id', 'DESC')->get();
        $totalComment = Comment::where('post_id', $post->id)->count();

        return compact('post', 'allComments', 'totalComment');
    }

    public function editPost($uuid)
    {
        $post = Post::with('user')->where('uuid', $uuid)->first();

        return compact('post');
    }

    public function remove($id)
    {
        $loggedInUser = Auth::user()->id;
        $post = Post::where('user_id', $loggedInUser)->where('id', $id)->delete();
    }
}
