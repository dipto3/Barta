<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PostService
{
    public function createPost($request)
    {
       $post = Post::create([
            'user_id' => Auth::user()->id,
            'uuid' => Str::uuid()->toString(),
            'total_views' => 1,
            'description' => $request->barta,
        ]);
     
    }

    public function remove($id){
        $loggedInUser = Auth::user()->id;
        $post = Post::where('user_id', $loggedInUser)->find($id);
        $post->delete();
    }
}
