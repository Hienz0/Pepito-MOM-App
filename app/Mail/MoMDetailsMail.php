<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class MoMDetailsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $notulen;
    public $notulenUrl; // Add property for the URL

    /**
     * Create a new message instance.
     *
     * @param $notulen
     * @param $notulenUrl
     */
    public function __construct($notulen, $notulenUrl)
    {
        $this->notulen = $notulen;
        $this->notulenUrl = $notulenUrl;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Generate the PDF from the view
        $pdf = Pdf::loadView('pdfs.mom_details_pdf', ['notulen' => $this->notulen]);

        return $this->view('emails.mom_details')
                    ->subject('Minutes of Meeting Details')
                    ->attachData($pdf->output(), 'MoMDetails.pdf', [
                        'mime' => 'application/pdf',
                    ])
                    ->with([
                        'notulen' => $this->notulen,
                        'notulenUrl' => $this->notulenUrl, // Pass the URL to the view
                    ]);
    }
}
