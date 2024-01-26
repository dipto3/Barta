<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Like;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Notifications\PostLike;
use App\Events\LikeUpdate;

class PostService
{
    public function create($request)
    {
        $user = Auth::user()->id;
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
        $post = Post::where('uuid', $uuid)->increment('total_views', 1);
        $post = Post::with('user')->where('uuid', $uuid)->first();
        $allComments = Comment::with('user')->where('post_id', $post->id)->orderBy('id', 'DESC')->get();
        $totalComment = Comment::where('post_id', $post->id)->count();

        return compact('post', 'allComments', 'totalComment');
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

    public function markAsRead($uuid)
    {
        $post = Post::where('uuid', $uuid)->first();

        $notifications = auth()->user()->unreadNotifications;
        foreach ($notifications as $notification) {
            if ($notification->data['post']['uuid'] == $uuid) {
                $notification->markAsRead();
            }
        }
    }

    public function like_unlike($id)
    {
        $loggedInUser = Auth::user()->id;
        $liked = Like::where('user_id', $loggedInUser)->where('post_id', $id)->first();

        $post = Post::find($id);
        $post->user->notifications()
            ->where('type', 'App\Notifications\PostLike')
            ->where('data->liker', $loggedInUser)
            ->where('data->post->id', $post->id)
            ->delete();
        // dd($post->id);
        // Unlike functionality 
        if ($liked) {
            $liked->delete();
        } else {
            // like functionality 
            $like = Like::create([
                'user_id' => $loggedInUser,
                'post_id' => $post->id,
                'liked' => true,
            ]);
            $post->user->notify(new PostLike($loggedInUser, $post));
            event(new LikeUpdate($post));
        }
    }
}
