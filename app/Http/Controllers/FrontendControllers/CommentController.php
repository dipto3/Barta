<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Services\CommentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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

        $data = $this->commentService->editComment($uuid, $id);
        return view('frontend.post.edit_comment', $data);
    }

    public function update(Request $request, $id){

        $this->commentService->updateComment($request, $id);
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
