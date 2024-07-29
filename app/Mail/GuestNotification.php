<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Notulen;

class GuestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $notulen;

    public function __construct(Notulen $notulen)
    {
        $this->notulen = $notulen;
    }

    public function build()
    {
        // Generate PDF
        $pdf = Pdf::loadView('pdfs.notulen_pdf', ['notulen' => $this->notulen]);

        // Create a unique file name for the PDF
        $pdfPath = 'notulen_' . $this->notulen->id . '.pdf';
        $pdf->save(storage_path("app/public/{$pdfPath}"));

        return $this->view('emails.guest_notification')
                    ->attach(storage_path("app/public/{$pdfPath}"), [
                        'as' => 'notulen.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}
