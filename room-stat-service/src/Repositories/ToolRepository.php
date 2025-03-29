<?php

namespace App\Repositories;


class ToolRepository extends Repository
{
    public function getByToken(string $token)
    {
        $q = "SELECT * FROM `tools` WHERE code = :code LIMIT 1";
        $stmt = $this->db->prepare($q);
        $stmt->bindParam(':code', $token, \PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $res;
    }
}
