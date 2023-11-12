<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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
            ->select('posts.*', 'users.name as user_name', 'users.userName as userName')
            ->first();
        return view('frontend.post.single_post', compact('post'));
    }
    public function edit($uuid)
    {
        $post = DB::table('posts')
            ->where('uuid', $uuid)
            ->first();
        return view('frontend.post.edit', compact('post'));
    }

    public function update(Request $request, $uuid)
    {
        $this->postService->updatePost($request, $uuid);
        return redirect()->back();
    }

    public function delete($id)
    {
        $this->postService->remove($id);
        return redirect('/home');

    }
}
