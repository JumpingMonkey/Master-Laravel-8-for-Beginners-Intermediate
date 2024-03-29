<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CommentPosted extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Comment was posted on your {$this->comment->commentable->title} blog post";
        return $this
// First example with full path
//            ->attach(
//                storage_path("app/public") . "/" . $this->comment->user->image->path,
//                ['as' => 'avatar.jpg',
//                    'mime' => 'image/jpg']
//            )
// Second example
//            ->attachFromStorage($this->comment->user->image->path, 'avatar.jpg')
// third example
//                ->attachFromStorageDisk('public', $this->comment->user->image->path, 'avatar.jpg')
//                ->attachData(Storage::get($this->comment->user->image->path), 'avatar.jpg', [
//                'as' => 'avatar.jpg',
//                    'mime' => 'image/jpg'
//            ])
            ->subject($subject)
            ->view('emails.posts.commented');
    }
}
