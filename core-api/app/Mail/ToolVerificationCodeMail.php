<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ToolVerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private string $code)
    {
        //
    }

    public function build(): self
    {
        return $this
            ->subject('Tool Verification Code')
            ->view('emails.tool-verification-code')
            ->with([
                'code' => $this->code,
            ]);
    }
}
