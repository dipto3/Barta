<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Models\Like;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $loggedInUser = Auth::user()->id;
        $liked = Like::where('user_id', $loggedInUser)->where('post_id', $id)->first();

        $post = Post::find($id);
        // dd($post->id);
        if ($liked) {

            $liked->delete();
        } else {

            Like::create([
                'user_id' => $loggedInUser,
                'post_id' => $post->id,
                'liked' => true,
            ]);
        }

        return redirect()->back();
    }

    public function markAsRead($uuid, $id)
    {
        $like = Like::where('id', $id)->first();
        // dd($like->id);
        $like->update(['read_at' => now()]);

        return redirect(route('singlePost', ['uuid' => $like->post->uuid]));

    }
}
