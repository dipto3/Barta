<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateFormRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile($uuid)
    {

        $user = User::where('uuid', $uuid)->first();
        $posts = Post::with(['comments', 'user'])->where('user_id', $user->id)->orderBy('id', 'DESC')->get();
        return view('frontend.profile.your_profile', compact('user', 'posts'));
    }

    public function edit($uuid)
    {

        $user = DB::table('users')->where('uuid', $uuid)->first();

        return view('frontend.profile.edit', compact('user'));
    }

    public function update(ProfileUpdateFormRequest $request, $id)
    {

        $request->validated();

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

        if ($userInfo) {
            return back()->with('success', 'User information updated Successfully!');
        }

        return back()->with('fail', 'Something went wrong!!');
    }
}