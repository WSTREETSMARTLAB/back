<?php

namespace App\Repositories;


use App\DTO\ToolDTO;
use PDO;

class ToolRepository extends Repository
{
    public function getByToken(string $token): ToolDTO
    {
        $q = "SELECT id, type, user_id, company_id, name FROM `tools` WHERE code = :code AND active = true LIMIT 1";
        $stmt = $this->db->prepare($q);
        $stmt->bindParam(':code', $token, \PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$res) {
            // todo throw exception
        }

        return new ToolDTO($res);
    }

    public function getToolSettings(int $toolId, int $userId): ToolDTO
    {
        $q = "SELECT settings FROM `tools` WHERE id = :id AND user_id = :user_id AND active = true LIMIT 1";
        $stmt = $this->db->prepare($q);
        $stmt->bindParam(':id', $toolId, \PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $res = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$res) {
            // todo throw exception
        }

        return new ToolDTO(json_decode($res, true));
    }
}
