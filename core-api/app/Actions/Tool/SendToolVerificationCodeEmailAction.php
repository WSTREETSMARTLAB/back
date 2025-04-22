<?php

namespace App\Actions\Tool;

use App\Mail\EmailVerificationCodeMail;
use App\Mail\ToolVerificationCodeMail;
use Illuminate\Support\Facades\Mail;

class SendToolVerificationCodeEmailAction
{
    public function handle(string $code)
    {
        $user = auth()->user();

        Mail::to($user->email)->send(new ToolVerificationCodeMail($code));
    }
}
