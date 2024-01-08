<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use App\Mail\AuthorMail;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

class NotifyAuthor
{
    /**
     * Create the event listener.
     */
    public function __construct(public Comment $comment, public Post $post)
    {

    }

    /**
     * Handle the event.
     */
    public function handle(CommentCreated $event): void
    {
        $postCreator = $event->post->user;
        $postCreatorEmail = $postCreator->email;
        Mail::to($postCreatorEmail)->send(new AuthorMail($event->comment));

    }
}
