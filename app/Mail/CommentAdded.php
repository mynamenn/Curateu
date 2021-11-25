<?php

namespace App\Mail;

use App\Models\Collection;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $liker;

    public $collection;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $liker, Collection $collection)
    {
        $this->liker = $liker;
        $this->collection = $collection;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.comment_added')
            ->subject($this->liker->name.' commented on your collection');
    }
}
