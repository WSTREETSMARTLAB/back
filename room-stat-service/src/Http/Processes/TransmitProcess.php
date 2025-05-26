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

        $alarmKeys = $this->session->keys("alarms:tool:{$tool->id()}:*");
        $alarmValues = $this->session->mget($alarmKeys);

        if ($alarmValues) {
            foreach ($alarmValues as &$value) {
                $value = json_decode($value, true);
            }
            unset($value);
        }

        $signal = [
            'params' => [
                'temperature' => round($signal->temperature(), 1),
                'humidity'    => round($signal->humidity(), 1),
                'light'       => round($signal->light(), 1),
            ],
            'alarms' => $alarmValues,
            'ts' => time()
        ];

        $ttl = 30;

        $this->session->setex("signal:last:{$token}", $ttl, json_encode($signal));

        $this->session->publish("sensor:{$token}:signal", json_encode($signal));
    }
}
