<?php

namespace App\Http\Transmitters;

use App\DTO\SignalDTO;
use App\Http\Processes\TransmitProcess;

class Transmitter
{
    public function transmit(SignalDTO $signal)
    {
        $process = new TransmitProcess();
        $process->handle($signal);

        return 'signal ok';
    }
}
