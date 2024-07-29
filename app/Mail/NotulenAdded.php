<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class NotulenAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $notulen;
    public $notulenUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notulen)
    {
        $this->notulen = $notulen;
        $this->notulenUrl = route('notulens.show', ['id' => $notulen->id]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            $pdf = Pdf::loadView('pdfs.notulen_pdf', ['notulen' => $this->notulen]);
            
            // Format the meeting title and date/time for the filename
            $meetingTitle = str_replace(' ', '_', $this->notulen->meeting_title); // Replace spaces with underscores
            $meetingDateTime = $this->notulen->meeting_date . '_' . $this->notulen->meeting_time; // Combine date and time
            $pdfFileName = "{$meetingTitle}_{$meetingDateTime}.pdf";

            return $this->view('emails.notulen_added')
                        ->with([
                            'notulen' => $this->notulen,
                            'notulenUrl' => $this->notulenUrl,
                        ])
                        ->attachData($pdf->output(), $pdfFileName, [
                            'mime' => 'application/pdf',
                        ]);
        } catch (\Exception $e) {
            Log::error('Error generating PDF for NotulenAdded email', [
                'notulen_id' => $this->notulen->id,
                'error' => $e->getMessage(),
            ]);
            throw $e; // Re-throw to handle further up if necessary
        }
    }
}
