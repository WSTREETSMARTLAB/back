<?php

namespace App\Repositories;

class AlarmRepository extends Repository
{
    public function registerAlarmStart(int $toolId, array $payload): int
    {
        $now = (new \DateTime())->format('Y-m-d H:i:s');

        $q = "INSERT INTO alarms (type, tool_id, value, start, end, resolved, created_at, updated_at) 
                VALUES (:type, :tool_id, :value, :start, :end, :resolved, :created_at, :updated_at)";
        $stmt = $this->db->prepare($q);
        $stmt->bindValue(':type', $payload['type']);
        $stmt->bindValue(':tool_id', $toolId);
        $stmt->bindValue(':value', $payload['value']);
        $stmt->bindValue(':start', $now);
        $stmt->bindValue(':end', null);
        $stmt->bindValue(':resolved', 0);
        $stmt->bindValue(':created_at', $now);
        $stmt->bindValue(':updated_at', $now);
        $stmt->execute();

        return (int) $this->db->lastInsertId();
    }

    public function registerAlarmEnd(int $toolId, int $alarmId): void
    {
        $now = (new \DateTime())->format('Y-m-d H:i:s');
        $q = "UPDATE alarms SET resolved = 1, end = :end, updated_at = :updated_at WHERE id = :alarm_id AND tool_id = :tool_id";
        $stmt = $this->db->prepare($q);
        $stmt->bindValue(':tool_id', $toolId);
        $stmt->bindValue(':alarm_id', $alarmId);
        $stmt->bindValue(':updated_at', $now);
        $stmt->bindValue(':end', $now);
        $stmt->execute();
    }
}
