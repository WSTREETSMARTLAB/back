<?php

namespace App\Domain\User\Actions;

use App\Domain\Profile\Models\Profile;
use App\Mail\EmailVerificationCodeMail;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationCodeAction
{
    public function handle(Profile $profile): void
    {
        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $profile->update([
            'email_verification_code' => $code,
            'email_verification_code_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($profile->email)->send(new EmailVerificationCodeMail($code));
    }
}
