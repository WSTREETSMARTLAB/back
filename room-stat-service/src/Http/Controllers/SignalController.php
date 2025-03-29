<?php

namespace App\Http\Controllers;

use App\DTO\SignalDTO;
use App\Http\Processes\ReceiveProcess;
use App\Http\Validators\SignalValidator;
use Symfony\Component\HttpFoundation\Request;

class SignalController
{
    public function receive(Request $request)
    {
        $data = (new SignalValidator(
            json_decode($request->getContent(), true)
        ))->validate();

        $signal = new SignalDTO(
            $data['temperature'],
            $data['humidity'],
            $data['light']
        );
        $process = new ReceiveProcess($signal);
        $process->handle();

        return 'signal ok';
    }
}
