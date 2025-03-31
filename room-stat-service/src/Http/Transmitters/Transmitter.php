<?php

namespace App\Http\Transmitters;

use App\Core\DependencyAccessor;
use App\DTO\SignalDTO;
use App\Http\Processes\TransmitProcess;

class Transmitter
{
    public function transmit(SignalDTO $signal)
    {
        $session = (new DependencyAccessor())->session();
        $process = new TransmitProcess($session);
        $process->handle($signal);

        return 'signal ok';
    }
}
