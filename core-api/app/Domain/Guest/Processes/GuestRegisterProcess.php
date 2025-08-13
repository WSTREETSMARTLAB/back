<?php

namespace App\Domain\Guest\Processes;

use App\Domain\Guest\DTO\GuestDTO;

class GuestRegisterProcess
{
    public function handle(GuestDTO $data): void
    {
        $this->repository->storeMeta($data);

        // create guest token
        // return back in response
    }
}
