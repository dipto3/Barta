<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateFormRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile($uuid)
    {
        $user = DB::table('users')->where('uuid', $uuid)->first();
        $posts = DB::table('posts')
        ->where('posts.user_id', $user->id)
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', DB::raw('COUNT(comments.id) as comments_count'),'users.id as userId','users.uuid as Useruuid', 'users.name as user_name','users.userName as userName')
        ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
        ->groupBy('posts.id')
        ->orderBy('id','DESC')
        ->get();
        // dd($posts);

        $totalComment = Comment::where('post_id', 'posts.id')->count();

        return view('frontend.profile.your_profile', compact('user','posts'));
    }

    public function edit($uuid)
    {

        $user = DB::table('users')->where('uuid', $uuid)->first();
        return view('frontend.profile.edit', compact('user'));
    }

    public function update(ProfileUpdateFormRequest $request, $id)
    {

        $request->validated();
        $userInfo = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'userName' => $request->userName,
            'bio' => $request->bio,
            'password' => Hash::make($request->password),
        ]);
        if ($userInfo) {
            return back()->with('success', 'User information updated Successfully!');

        } else {
            return back()->with('fail', 'Something went wrong!!');
        }
    }

}
