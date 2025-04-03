<?php

namespace App\DTO\User;


class UserDTO
{
    private int $id;
    private string $username;
    private string $email;
    private string $role;
    private string $active;
    private ?int $companyId;
    private ?string $avatar;

    public function __construct(private array $data)
    {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->role = $data['role'];
        $this->active = $data['active'];
        $this->companyId = $data['company_id'];
        $this->avatar = $data['avatar'];
    }

    public function id(): int
    {
        return $this->id;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function role(): string
    {
        return $this->role;
    }

    public function active(): string
    {
        return $this->active;
    }

    public function companyId(): int
    {
        return $this->companyId;
    }

    public function avatar(): string
    {
        return $this->avatar;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
            'active' => $this->active,
            'company_id' => $this->companyId,
            'avatar' => $this->avatar,
        ];
    }
}
