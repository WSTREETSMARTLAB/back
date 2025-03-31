<?php

namespace App\Http\Processes;

use App\DTO\SignalDTO;

class TransmitProcess
{
    public function __construct(private \Redis $session)
    {
    }

    public function handle(SignalDTO $signal)
    {
        $token = $this->session->get('token');
        $tool = json_decode($this->session->get('tool'), true);

        $payload = [
            'sensor_id'   => $tool['id'],
            'type'        => $tool['type'],
            'user_id'     => $tool['user_id'],
            'company_id'  => $tool['company_id'],
            'name'        => $tool['name'],
            'temperature' => $signal->temperature(),
            'humidity'    => $signal->humidity(),
            'light'       => $signal->light(),
        ];

        $this->session->publish("sensor:{$token}:signal", json_encode($payload));
    }
}
