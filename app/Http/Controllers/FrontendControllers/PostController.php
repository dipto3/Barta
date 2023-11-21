<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Models\Comment;
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

    public function store(PostFormRequest $request)
    {
        $request->validated();
        // return (new PostService)->createPost($request);
        $this->postService->createPost($request);
        toastr()->addSuccess('', 'Post Created Successfully.');
        return redirect()->back();
    }

    public function single_post($uuid)
    {
        $data = $this->postService->singlePost($uuid);
        return view('frontend.post.single_post', $data);
    }
    public function edit($uuid)
    {
        $data = $this->postService->editPost($uuid);
        return view('frontend.post.edit', $data);
    }

    public function update(Request $request, $uuid)
    {
        $this->postService->updatePost($request, $uuid);
        toastr()->addInfo('', 'Post Updated Successfully.');
        return redirect('/home');
    }

    public function delete($id)
    {
        $this->postService->remove($id);
        toastr()->addInfo('', 'Post Removed Successfully.');
        return redirect('/home');

    }
}
