<?php

namespace App\Domain\User\Actions;

use App\Domain\User\Models\User;
use App\Mail\EmailVerificationCodeMail;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationCodeAction
{
    public function handle(User $user): void
    {
        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'email_verification_code' => $code,
            'email_verification_code_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new EmailVerificationCodeMail($code, $user->username));
    }
}
