<?php

namespace App\Http\Controllers\FrontendControllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Services\PostService;
use Illuminate\Http\Request;


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
        $this->postService->create($request);
        toastr()->addSuccess('', 'Post Created Successfully.');

        return redirect()->back();
    }
    // post details page
    public function single_post($uuid)
    {
        $data = $this->postService->singlePost($uuid);

        return view('frontend.post.single_post', $data);
    }

    public function edit($uuid)
    {
        $data = $this->postService->edit($uuid);
        return view('frontend.post.edit', $data);
    }

    public function update(Request $request, $uuid)
    {
        $this->postService->update($request, $uuid);
        toastr()->addInfo('', 'Post Updated Successfully.');
        return redirect('/home');
    }

    public function delete($id)
    {
        $this->postService->remove($id);
        toastr()->addInfo('', 'Post Removed Successfully.');
        return redirect('/home');
    }

    public function like_unlike($id)
    {
        $this->postService->like_unlike($id);
        return redirect()->back();
    }

    // When user click notification redirect to the post & mark as read 
    public function markAsRead($uuid)
    {
        $this->postService->markAsRead($uuid);
        return redirect()->route('singlePost', ['uuid' => $uuid]);
    }
}
