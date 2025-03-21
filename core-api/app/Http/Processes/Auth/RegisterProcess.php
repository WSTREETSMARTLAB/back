<?php

namespace App\Http\Processes\Auth;

use App\Mail\EmailVerificationCodeMail;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterProcess
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function handle(array $data): void
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);

        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'email_verification_code' => $code,
            'email_verification_code_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new EmailVerificationCodeMail($code, $user->username));
    }
}
