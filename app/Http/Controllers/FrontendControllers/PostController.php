<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(Request $request)
    {
        // return (new PostService)->createPost($request);
        $this->postService->createPost($request);

        return redirect()->back();
    }
    public function single_post($id){
        $post = Post::find($id);
        return view('frontend.single_post',compact('post'));
    }

    public function delete($id){

        $loggedInUser = Auth::user()->id;
        // dd($loggedInUser);

            $post = Post::where('user_id',$loggedInUser)->find($id);
            $post->delete();
            return redirect()->back();


    }
}
