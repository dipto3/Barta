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
    #[On('echo:comment, CommentCreated')]

    public function render()
    {
        $totalLikeCount = auth()->user()->unreadNotifications->count();
        $notifications = auth()->user()->unreadNotifications;
        return view('livewire.like-notification', [
            'totalLikeCount' => $totalLikeCount,
            'notifications' => $notifications,
        ]);
    }
}
