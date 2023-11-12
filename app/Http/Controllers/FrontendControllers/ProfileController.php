<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {

        $loggedInUser = Auth::user();
        return view('frontend.profile.your_profile', compact('loggedInUser'));
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
