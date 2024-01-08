<?php

namespace App\Services;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeService
{
    public function home()
    {

        $allPosts = Post::with(['comments', 'user'])->orderBy('id', 'DESC')->get();

        $user_id = Auth::user()->id;

        //         $likeCount = User::with(['post.likes'])->where('id', $user_id)->count();
        // dd($likeCount);
        // $user = User::with(['post.likes.user' => function ($query) {
        //     $query->select('post_id', DB::raw('count(*) as like_count'))->where('read_at',null)
        //         ->groupBy('post_id');
        // }])->find($user_id);
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

        return compact('allPosts', 'totalLikeCount', 'user');
    }

    public function search($request)
    {
        $request->validated();
        $input = $request->search;
        $user = User::with(['comments', 'post'])->where('name', 'like', '%'.$input.'%')
            ->orWhere('email', 'like', '%'.$input.'%')
            ->orWhere('userName', 'like', '%'.$input.'%')
            ->get();

        return compact('user');
    }
}
