<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Services\CommentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function store(CommentRequest $request)
    {
        $this->commentService->createComment($request);
        toastr()->addSuccess('', 'Comment Created Successfully.');
        return redirect()->back();
    }

    public function edit($uuid, $id)
    {

        $post = DB::table('posts')
            ->where('posts.uuid', $uuid)
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name as user_name', 'users.id as uid', 'users.userName as userName', 'users.uuid as userUuid')
            ->first();

        $comment = DB::table('comments')
            ->where('comments.id', $id)
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->select('comments.*')
            ->first();
        // dd($comment);
        return view('frontend.post.edit_comment', compact('post', 'comment'));
    }

    public function update(Request $request, $id){


        // dd($request->comment);
        $loggedInUser = Auth::user()->id;
        $post = DB::table('comments')
        ->where('user_id',$loggedInUser)
        ->where('id', $id)
        ->update([
            'comment' => $request->comment,
            'updated_at' => Carbon::now()
        ]);
        return redirect()->back();

    }

    public function delete($id)
    {
        $this->commentService->remove($id);
        toastr()->addInfo('', 'Comment Removed Successfully.');
        return redirect()->back();

    }
}
