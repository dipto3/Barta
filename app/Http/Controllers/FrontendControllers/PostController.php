<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

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

    public function single_post($uuid)
    {
        $post = DB::table('posts')
        ->where('uuid', $uuid)
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.name as user_name','users.userName as userName')
        ->first();
        return view('frontend.single_post', compact('post'));
    }

    public function delete($id)
    {
        $this->postService->remove($id);
        return redirect()->back();
    }
}
