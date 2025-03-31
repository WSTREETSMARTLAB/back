<?php

namespace App\DTO;

class ToolDTO
{
    private readonly string $id;
    private readonly string $type;
    private readonly string $userId;
    private readonly string $companyId;
    private readonly string $name;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->type = $data['type'];
        $this->userId = $data['user_id'];
        $this->companyId = $data['company_id'];
        $this->name = $data['name'];
    }
}
