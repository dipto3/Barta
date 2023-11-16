<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile($id)
    {

        $user = DB::table('users')->where('id', $id)->first();
        $posts = DB::table('posts')->where('user_id', $id)->orderBy('id','DESC')->get();

        // $posts = DB::table('users')
        //                 ->join('posts', 'posts.user_id', 'users.id')
        //                 ->where('users.id', $id)
        //                 ->orderBy('posts.id','DESC')
        //                 ->get();

        // $posts = DB::table('users')
        //             ->where('users.id', $id)
        //             ->join('posts', 'posts.user_id', 'users.id')
        //             ->orderBy('posts.id', 'DESC')
        //             ->select('posts.*', 'name', 'bio', 'userName')
        //             ->get();
        // dd($posts);

        return view('frontend.profile.your_profile', compact('user','posts'));
    }

    public function edit($id)
    {

        $user = User::find($id);
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
