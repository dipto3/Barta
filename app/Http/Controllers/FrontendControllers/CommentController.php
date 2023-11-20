<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Requests\CommentRequest;
class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function store(CommentRequest $request){
        $this->commentService->createComment($request);
        toastr()->addSuccess('','Comment Created Successfully.');
        return redirect()->back();
    }

    public function delete($id)
    {
        $this->commentService->remove($id);
        toastr()->addInfo('', 'Comment Removed Successfully.');
        return redirect()->back();

    }
}
