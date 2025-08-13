<?php

namespace App\Repositories;


use App\DTO\ToolDTO;
use App\System\Abstract\Repository;

class ToolRepository extends Repository
{
    private const TOKEN_EXPIRATION_TIME = 3600 * 24 * 30;

    public function getByToken(string $token): ToolDTO
    {
        $interval = new \DateInterval('PT'.self::TOKEN_EXPIRATION_TIME.'S');
        $expire = (new \DateTime('now', null))->add($interval)->getTimestamp();

        $q = "SELECT t.id, t.type, t.user_id, t.company_id, t.name, t.settings 
              FROM `tool_access_tokens` tat
              JOIN tools t ON t.code = tat.code 
              WHERE tat.token = :token 
              AND t.active = true 
              AND tat.expires_at >= $expire
              LIMIT 1";

        $stmt = $this->db->prepare($q);
        $stmt->bindParam(':token', $token, \PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$res) {
            throw new \RuntimeException('Invalid token');
        }

        $res['settings'] = json_decode($res['settings'], true);

        return new ToolDTO($res);
    }
}
