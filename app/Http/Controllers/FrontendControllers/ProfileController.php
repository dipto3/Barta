<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class ProfileController extends Controller
{
    public function profile($id)
    {

        // $loggedInUser = Auth::user();
        // $loggedInUser = DB::table('posts')

        // ->join('users', 'posts.user_id', '=', 'users.id')
        // ->select('posts.*', 'users.name as user_name','users.userName as userName')
        // ->where('posts.user_id','users.id')
        // // ->orderBy('id','DESC')
        // ->get();
        $user = DB::table('users')->where('id', $id)->first();
        $posts = DB::table('posts')->where('user_id', $id)->get();
        return view('frontend.profile.your_profile', compact('user', 'posts'));
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
