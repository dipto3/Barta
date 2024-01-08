<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostService
{
    public function create($request)
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

    public function update($request, $uuid)
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
        $user_id = Auth::user()->id;
        $users = User::with(['post.likes' => function ($query) {
            $query->select('post_id', DB::raw('count(*) as like_count'))->where('read_at', null)
                ->groupBy('post_id');
        }])->find($user_id);
        $user = User::with(['post.user.likes' => function ($query) {
            $query->select('post_id', DB::raw('count(*) as like_count'))->where('read_at', null)
                ->groupBy('post_id');
        }])->find($user_id);
        // dd($user->post);
        $totalLikeCount = 0;
        foreach ($users->post as $post) {
            // dd($post);
            $postId = $post->id;
            $likeCount = $post->likes->sum('like_count');
            $totalLikeCount += $likeCount;
        }
        $post = Post::where('uuid', $uuid)->increment('total_views', 1);
        $post = Post::with('user')->where('uuid', $uuid)->first();
        $allComments = Comment::with('user')->where('post_id', $post->id)->orderBy('id', 'DESC')->get();
        $totalComment = Comment::where('post_id', $post->id)->count();

        return compact('post', 'allComments', 'totalComment', 'totalLikeCount', 'user');
    }

    public function edit($uuid)
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
