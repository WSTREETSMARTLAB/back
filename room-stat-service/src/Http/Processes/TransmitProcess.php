<?php

namespace App\Http\Processes;

use App\Core\DependencyAccessor;
use App\DTO\SignalDTO;
use App\Repositories\ToolRepository;

class TransmitProcess
{
    private ToolRepository $toolRepository;

    public function __construct(private \Redis $session)
    {
        $this->toolRepository = new ToolRepository((new DependencyAccessor())->db());
    }

    public function handle(SignalDTO $signal)
    {
        $token = $this->session->get('token');
        $tool = json_decode($this->session->get('tool'), true);

        $tool['alarms'] = $this->analyzeSignal($signal);

        $payload = [
            'sensor_id'   => $tool['id'],
            'type'        => $tool['type'],
            'user_id'     => $tool['user_id'],
            'company_id'  => $tool['company_id'],
            'name'        => $tool['name'],
            'temperature' => $signal->temperature(),
            'humidity'    => $signal->humidity(),
            'light'       => $signal->light(),
            'alarms'      => $tool['alarms'],
        ];

        $this->session->publish("sensor:{$token}:signal", json_encode($payload));
    }

    private function analyzeSignal(SignalDTO $signal = null): array
    {
        return [

        ];
    }
}
