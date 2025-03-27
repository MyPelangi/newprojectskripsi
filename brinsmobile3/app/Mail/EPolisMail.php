<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\Polis;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class EPolisMail extends Mailable
{
    use Queueable, SerializesModels;

    public $polis;
    public $password;

    public function __construct(Polis $polis)
    {
        $this->polis = $polis;

        if ($polis->user) {
            $this->password = $polis->user->tgl_lahir
                ? Carbon::parse($polis->user->tgl_lahir)->format('dmY')
                : '00000000';
        } else {
            $this->password = '00000000';
            \Log::error('User tidak ditemukan untuk polis ID: ' . $polis->id);
        }
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'E-Polis Asuransi Anda'
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.epolis',
            with: [
                'polis' => $this->polis,
                'password' => $this->password
            ]
        );
    }

    public function attachments()
    {
        return [
            Attachment::fromPath(storage_path('app/' . $this->polis->e_polis_path))
                ->as('EPolis_' . $this->polis->nomor_polis . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
