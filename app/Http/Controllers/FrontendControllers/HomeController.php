<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home(){
        // $allPosts = DB::table('posts')
        // ->join('users', 'posts.user_id', '=', 'users.id')
        // ->select('posts.*', DB::raw('COUNT(comments.id) as comments_count'),'users.id as userId','users.uuid as Useruuid', 'users.name as user_name','users.userName as userName')
        // ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
        // ->groupBy('posts.id')
        // ->orderBy('id','DESC')
        // ->get();
        $allPosts = Post::with(['comments', 'user'])->orderBy('id','DESC')->get();
        // dd($allPosts);
        return view('frontend.home',compact('allPosts'));
    }
}
