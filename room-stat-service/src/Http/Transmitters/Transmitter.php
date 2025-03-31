<?php

namespace App\Http\Transmitters;

use App\DTO\SignalDTO;
use App\Http\Processes\ReceiveProcess;

class Transmitter
{
    public function transmit(SignalDTO $signal)
    {
        $process = new ReceiveProcess($signal);
        $process->handle();

        return 'signal ok';
    }
}
