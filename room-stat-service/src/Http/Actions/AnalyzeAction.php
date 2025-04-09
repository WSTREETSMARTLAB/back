<?php

namespace App\Http\Actions;

use App\Core\DependencyAccessor;
use App\Repositories\AlarmRepository;

class AnalyzeAction
{
    protected AlarmRepository $alarmRepository;
    protected \Redis $session;
    protected int $toolId;

    public function __construct(protected array $settings)
    {
        $accessor = new DependencyAccessor();
        $this->alarmRepository = new AlarmRepository($accessor->db());
        $this->session = $accessor->session();
        $this->toolId = json_decode($this->session->get('tool'), true)['id'];
    }

    protected function alarmKey(string $alarm): string
    {
        return "alarms:tool:{$this->toolId}:{$alarm}";
    }

    protected function startAlarm(string $alarm, float $value): void
    {
        $key = $this->alarmKey($alarm);

        if (!$this->session->exists($key)) {
            $alarmId = $this->alarmRepository->registerAlarmStart($this->toolId, [
                'value' => $value,
                'type' => $alarm,
            ]);
            $this->session->set($key, json_encode([
                'time' => (new \DateTime())->format('Y-m-d H:i:s'),
                'id' => $alarmId
            ]));
            $this->session->expire($key, 86400);
        }
    }

    protected function resolveAlarm(string $alarm): void
    {
        $key = $this->alarmKey($alarm);

        if ($this->session->exists($key)) {
            $value = json_decode($this->session->get($key), true);
            $this->alarmRepository->registerAlarmEnd($this->toolId, $value['id']);
            $this->session->del($key);
        }
    }
}
