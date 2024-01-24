<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostComment extends Notification
{
    use Queueable;

    public $commenter;

    public $post;

    public $comment;

    // public $post;
    /**
     * Create a new notification instance.
     */
    public function __construct($commenter, $comment, $post)
    {
        $this->commenter = $commenter;
        $this->comment = $comment;
        $this->post = $post;
        // $this->post = $comment->post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => auth()->user()->name.' commented on your post.',
            'commenter' => $this->commenter,
            'comment' => $this->comment,
            'post' => [
                'uuid' => $this->post->uuid,

            ],
        ];
    }
}
