<?php

namespace App\Http\Processes;

use App\Core\DependencyAccessor;
use App\DTO\SignalDTO;
use App\DTO\ToolDTO;
use App\Http\Validators\SignalDeviationAnalyzer;
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
        $tool = new ToolDTO(json_decode($this->session->get('tool'), true));

        (new SignalDeviationAnalyzer($tool))->analyze($signal);

        $payload = [
            'sensor_id'   => $tool->id(),
            'type'        => $tool->type(),
            'user_id'     => $tool->userId(),
            'company_id'  => $tool->companyId(),
            'name'        => $tool->name(),
            'temperature' => $signal->temperature(),
            'humidity'    => $signal->humidity(),
            'light'       => $signal->light(),
        ];

        $this->session->publish("sensor:{$token}:signal", json_encode($payload));
        $this->session->publish("sensor:{$token}:alarms", $this->session->get('alarms'));
    }
}
