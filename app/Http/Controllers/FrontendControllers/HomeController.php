<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
class HomeController extends Controller
{
    public function home(){
        $allPosts = Post::latest()->get();
        return view('frontend.home',compact('allPosts'));
    }
}
