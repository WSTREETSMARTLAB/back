<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private string $code, private string $username)
    {
    }

    public function build(): self
    {
        return $this
            ->subject('Welcome to WSTREET SMART LAB')
            ->view('emails.verification-code')
            ->with([
                'username' => $this->username,
                'code' => $this->code,
            ]);
    }
}
