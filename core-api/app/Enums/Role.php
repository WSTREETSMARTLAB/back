<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case User = 'user';

    public function permissions(): array
    {
        return match ($this) {
            self::Admin => [
                Permission::ManageUsers,
                Permission::ViewUsers,
                Permission::ManageCompanies,
                Permission::ViewCompanies,
                Permission::ViewDashboard,
            ],
            self::User => [
                Permission::ViewDashboard,
            ],
        };
    }

    public function hasPermission(Permission $permission): bool
    {
        return in_array($permission, $this->permissions(), true);
    }
}
