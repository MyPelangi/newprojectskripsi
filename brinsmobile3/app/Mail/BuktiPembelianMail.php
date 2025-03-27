<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Polis;
use Illuminate\Support\Facades\Storage;

class BuktiPembelianMail extends Mailable
{
    use Queueable, SerializesModels;

    public $polis;
    public $penutupan;

    public function __construct($polis, $penutupan)
    {
        $this->polis = $polis;
        $this->penutupan = $penutupan;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Cover Note | Bukti Pembelian Asuransi'
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.bukti_pembelian',
            with: [
                'polis' => $this->polis,
                'penutupan' => $this->penutupan,
            ],
        );
    }

    public function attachments()
    {
        return [
            Attachment::fromPath(storage_path('app/' . $this->polis->cover_note_path))
                ->as('CoverNote_' . $this->polis->nomor_polis . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
