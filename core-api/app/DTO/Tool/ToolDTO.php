<?php

namespace App\DTO\Tool;

use App\Models\Tool;

class ToolDTO
{
    private int $id;
    private ?string $name;
    private string $type;
    private string $code;
    private ?bool $active;
    private ?string $lastOnline;

    public function __construct(Tool $data)
    {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->type = $data->type;
        $this->code = $data->code;
        $this->active = $data->active;
        $this->lastOnline = $data->lastOnline;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function active(): bool
    {
        return $this->active;
    }

    public function lastOnline(): string
    {
        return $this->lastOnline;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'code' => $this->code,
            'active' => $this->active,
            'last_online_at' => $this->lastOnline,
        ];
    }
}
