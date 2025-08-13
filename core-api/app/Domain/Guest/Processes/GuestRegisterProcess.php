<?php

namespace App\Domain\Guest\Processes;

use App\Domain\Guest\DTO\GuestDTO;
use App\Domain\Guest\Repositories\GuestRepository;

class GuestRegisterProcess
{
    public function __construct(private GuestRepository $repository)
    {
    }

    public function handle(GuestDTO $data): string
    {
        $guest = $this->repository->storeMeta($data);

        $token = $guest->createToken(
            name: 'guest_token',
            abilities: ['guest']
        );

        return $token->plainTextToken;
    }
}
