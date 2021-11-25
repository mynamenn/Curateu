<?php

namespace App\Mail;

use App\Models\Item;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ItemLiked extends Mailable
{
    use Queueable, SerializesModels;

    public $liker;

    public $item;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $liker, Item $item)
    {
        $this->liker = $liker;
        $this->item = $item;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.item_liked')
            ->subject($this->liker->name.' liked your item');
    }
}
