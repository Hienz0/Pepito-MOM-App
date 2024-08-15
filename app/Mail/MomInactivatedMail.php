<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MomInactivatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $notulen; // Add the notulen instance

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notulen)
    {
        $this->notulen = $notulen; // Pass the notulen instance
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('MoM Inactivated Notification')
                    ->view('emails.mom_inactivated'); // Refer to the view you create next
    }
}
