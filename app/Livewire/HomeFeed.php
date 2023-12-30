<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class HomeFeed extends Component
{
    public $amount = 5;

    public function loadMore()
    {
        $this->amount += 5;
    }

    public function render()
    {
        $posts = Post::with(['comments', 'user'])->take($this->amount)->latest()->get();

        return view('livewire.home-feed', compact('posts'));
    }
}
