<?php

namespace App\Services;

use App\Http\Requests\ProfileUpdateFormRequest;
use App\Models\Post;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class ProfileService
{
    public function profile($uuid)
    {
        $user = User::with(['comments', 'post'])->where('uuid', $uuid)->first();
        $posts = Post::with(['comments', 'user'])->where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        return compact('user', 'posts');
    }
    public function edit($uuid)
    {

        $user = User::where('uuid', $uuid)->first();
        return compact('user');
    }

    public function update($request, $id)
    {
        $userInfo = User::where('id', $id)->first();
        $userInfo->update([
            'name' => $request->name,
            'email' => $request->email,
            'userName' => $request->userName,
            'bio' => $request->bio,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('profileimage')) {
            $userInfo->clearMediaCollection();
            $userInfo->addMediaFromRequest('profileimage')->toMediaCollection();
        }
    }
}
