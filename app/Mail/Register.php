<?php

namespace App\Mail;

use App\Models\User\RegisterInvite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public RegisterInvite $invite)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Регистрация',
            metadata: ['invite' => $this->invite]
        );
    }

    public function content(): Content
    {
        return new Content(view:'mail.register');
    }

    public function attachments(): array
    {
        return [];
    }
}
