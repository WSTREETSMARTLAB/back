<?php

namespace App\Http\Transmitters;

use App\DTO\SignalDTO;
use App\Http\Processes\ReceiveProcess;
use App\Http\Validators\SignalValidator;
use Symfony\Component\HttpFoundation\Request;

class Transmitter
{
    public function receive(Request $request)
    {
        $requestData = json_decode($request->getContent(), true);

        $rules = [
            'temperature' => ['required', 'integer', 'min:-1', 'max:60'],
            'humidity' => ['required', 'numeric', 'between:0,100'],
            'light' => ['required', 'numeric', 'between:0,100'],
        ];

        $data = (new SignalValidator($requestData))->validate($rules);

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
