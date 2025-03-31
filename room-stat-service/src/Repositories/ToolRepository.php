<?php

namespace App\Repositories;


use App\DTO\ToolDTO;
use PDO;

class ToolRepository extends Repository
{
    public function getByToken(string $token): ToolDTO
    {
        $q = "SELECT id, type, user_id, company_id, name FROM `tools` WHERE code = :code AND is_active = true LIMIT 1";
        $stmt = $this->db->prepare($q);
        $stmt->bindParam(':code', $token, \PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$res) {
            // todo throw exception
        }

        return new ToolDTO($res);
    }
}
