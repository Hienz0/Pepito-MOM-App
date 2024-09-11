<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MomInactivatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $notulen; // Add the notulen instance
    public $inactivatedMoMUrl; // Add the URL instance


    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($notulen, $inactivatedMoMUrl)
    {
        $this->notulen = $notulen;
        $this->inactivatedMoMUrl = $inactivatedMoMUrl; // Initialize the URL variable
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('MoM Inactivated Notification')
                    ->view('emails.mom_inactivated')
                    ->with([
                        'inactivatedMoMUrl' => $this->inactivatedMoMUrl, // Pass URL to view
                    ]); // Refer to the view you create next
    }
}
