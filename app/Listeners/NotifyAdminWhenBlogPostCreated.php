<?php

namespace App\Listeners;

use App\Events\BlogPostPosted;
use App\Jobs\ThrottledMail;
use App\Mail\BlogPostAdded;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyAdminWhenBlogPostCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param BlogPostPosted $event
     * @return void
     */
    public function handle(BlogPostPosted $event)
    {
        User::thatIsAnAdmin()->get()
        ->map(function (User $users){
            ThrottledMail::dispatch(
                new BlogPostAdded(),
                $users
            );
        });
    }
}
