<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class LikeNotification extends Component
{
    #[On('echo:like-update, LikeUpdate')]
    public function likeUpdate($event)
    {

        $like = $event['like'];
        $user_id = Auth::user()->id;
        $likes = User::with(['post.likes' => function ($query) {
            $query->select('post_id', DB::raw('count(*) as like_count'))->where('read_at', null)
                ->groupBy('post_id');
        }])->find($user_id);
        $totalLikeCount = 0;
        foreach ($likes->post as $post) {
            // dd($post);

            $likeCount = $post->likes->sum('like_count');
            $totalLikeCount += $likeCount;
        }
    }

    public function render()
    {

        $user_id = Auth::user()->id;

        // $like = User::with(['post.user.likes' => function ($query) {
        //     $query->select('post_id', DB::raw('count(*) as like_count'))->where('read_at', null)
        //         ->groupBy('post_id');
        // }])->find($user_id);
        // dd($user->post);
        // $likes = User::with(['post.likes' => function ($query) {
        //     $query->select('post_id', DB::raw('count(*) as like_count'))->where('read_at', null)
        //         ->groupBy('post_id');
        // }])->find($user_id);
        // $totalLikeCount = 0;
        // foreach ($likes->post as $post) {
        //     // dd($post);

        //     $likeCount = $post->likes->sum('like_count');
        //     $totalLikeCount += $likeCount;
        // }
        return view('livewire.like-notification');
        // return view('livewire.like-notification', [
        //     // 'totalLikeCount' => $totalLikeCount,
        //     // 'like' => $like,
        //     // 'notifications' => $notifications,
        // ]);
    }
}
