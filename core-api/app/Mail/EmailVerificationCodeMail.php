<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerificationCodeMail extends Mailable
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
            ->view('emails.email-verification-code')
            ->with([
                'username' => $this->username,
                'code' => $this->code,
            ]);
    }
}
