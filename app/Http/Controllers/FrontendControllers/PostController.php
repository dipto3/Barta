<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Events\LikeUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Models\Like;
use App\Models\Post;
use App\Notifications\PostLike;
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
        $post->user->notifications()
            ->where('type', 'App\Notifications\PostLike')
            ->where('data->liker', $loggedInUser)
            ->where('data->post->id', $post->id)
            ->delete();
        // dd($post->id);
        if ($liked) {
            $liked->delete();
        } else {

            $like = Like::create([
                'user_id' => $loggedInUser,
                'post_id' => $post->id,
                'liked' => true,
            ]);
            $post->user->notify(new PostLike($loggedInUser, $post));
            // event(new LikeUpdate($like));
        }

        return redirect()->back();
    }

    public function markAsRead($uuid)
    {
        $post = Post::where('uuid', $uuid)->first();
        if ($post) {
            $notifications = auth()->user()->unreadNotifications;
            foreach ($notifications as $notification) {

                if ($notification->data['post']['uuid'] == $uuid) {
                    $notification->markAsRead();
                }
            }

            return redirect()->route('singlePost', ['uuid' => $uuid]);
        }

        return redirect()->route('home');
    }
}
