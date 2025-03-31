<?php

namespace App\Http\Transmitters;

use App\DTO\SignalDTO;
use App\Http\Processes\ReceiveProcess;
use Symfony\Component\HttpFoundation\Request;

class Transmitter
{
    public function transmit(Request $request) // todo in SignalDTO instead of Request
    {
        $requestData = json_decode($request->getContent(), true);
        $signal = new SignalDTO($requestData);
        $process = new ReceiveProcess($signal);
        $process->handle();

        return 'signal ok';
    }
}
