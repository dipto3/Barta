<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;

class HomeService
{
    public function home()
    {
        $allPosts = Post::with(['comments', 'user'])->orderBy('id', 'DESC')->get();

        return compact('allPosts');
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
