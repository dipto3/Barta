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
        $post = DB::table('posts')->where('uuid', $uuid)->increment('total_views', 1);
        $post = DB::table('posts')
            ->where('posts.uuid', $uuid)
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name as user_name', 'users.id as uid', 'users.userName as userName', 'users.uuid as userUuid')
            ->first();

        $allPost = DB::table('users')
            ->where('comments.post_id',$post->id)
            ->join('comments', 'users.id', '=', 'comments.user_id')
            ->select('users.*', 'comment', 'comments.id as commentId', 'comments.user_id as commentuId', 'comments.created_at as commentCreatedAt')
            ->orderBy('comments.id','DESC')
            ->get();
        // dd($allpost);
        $totalComment = Comment::where('post_id', $post->id)->count();
        return view('frontend.post.single_post', compact('post', 'totalComment', 'allPost'));
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
