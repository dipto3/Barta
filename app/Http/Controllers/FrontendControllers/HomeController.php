<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SearchFormRequest;

class HomeController extends Controller
{
    public function home()
    {
        $allPosts = Post::with(['comments', 'user'])->orderBy('id', 'DESC')->get();
        return view('frontend.home', compact('allPosts'));
    }

    public function search(SearchFormRequest $request)
    {
        $request->validated();
        $input = $request->search;
        $user = User::with(['comments', 'post'])->where('name', 'like', '%' . $input . '%')
            ->orWhere('email', 'like', '%' . $input . '%')
            ->orWhere('userName', 'like', '%' . $input . '%')
            ->get();
    //   dd($user);
        return view('frontend.search', compact('user'));

    }
}
