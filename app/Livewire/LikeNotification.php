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
    public $totalLikeCount = 0;
    public $notifications = [];

    // Livewire listeners for broadcast events
    #[On('echo:like-update, LikeUpdate')]
    #[On('echo:comment, CommentCreated')]

    public function mount()
    {
      
        // Initial setup when the component is mounted
        $this->refreshNotifications();
    }

  

    public function refreshNotifications()
    {
        // Logic to refresh notifications
        $this->totalLikeCount = auth()->user()->unreadNotifications->count();
        $this->notifications = auth()->user()->unreadNotifications;
    }


    public function render()
    {

        return view('livewire.like-notification', [
            'totalLikeCount' => $this->totalLikeCount,
            'notifications' => $this->notifications,
        ]);
    }
}
