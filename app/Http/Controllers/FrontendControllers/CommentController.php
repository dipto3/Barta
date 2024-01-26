<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Events\CommentCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(CommentRequest $request)
    {
        $comment = $this->commentService->create($request);
        //dispatch event (For mail send)
        event(new CommentCreated($comment, $comment->post));
        toastr()->addSuccess('', 'Comment Created Successfully.');

        return redirect()->back();
    }

    public function edit($uuid, $id)
    {

        $data = $this->commentService->edit($uuid, $id);

        return view('frontend.post.edit_comment', $data);
    }

    public function update(Request $request, $id)
    {

        $this->commentService->update($request, $id);
        toastr()->addInfo('', 'Comment Updated Successfully.');

        return redirect()->back();
    }

    public function delete($id)
    {
        $this->commentService->remove($id);

        toastr()->addInfo('', 'Comment Removed Successfully.');

        return redirect()->back();
    }
}
