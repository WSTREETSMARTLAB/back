<?php

namespace App\Http\Processes;

use App\DTO\SignalDTO;

class ReceiveProcess
{
    public function __construct(private SignalDTO $signal)
    {
    }

    public function handle(){

    }
}
