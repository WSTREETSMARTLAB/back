<?php

namespace App\DTO;

class ToolDTO
{
    private string $id;
    private string $type;
    private int $userId;
    private ?int $companyId;
    private ?string $name;
    private ?array $settings;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->type = $data['type'];
        $this->userId = $data['user_id'];
        $this->companyId = $data['company_id'];
        $this->name = $data['name'];
        $this->settings = $data['settings'];
    }

    public function id()
    {
        return $this->id;
    }

    public function type()
    {
        return $this->type;
    }

    public function userId()
    {
        return $this->userId;
    }

    public function companyId()
    {
        return $this->companyId;
    }

    public function name()
    {
        return $this->name;
    }

    public function settings()
    {
        return $this->settings;
    }

    public function all(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'user_id' => $this->userId,
            'company_id' => $this->companyId,
            'name' => $this->name,
            'settings' => $this->settings,
        ];
    }
}
