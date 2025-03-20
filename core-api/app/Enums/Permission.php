<?php

namespace App\Enums;

enum Permission: string
{
    // examples
    case ManageUsers = 'manage_users';
    case ManageCompanies = 'manage_companies';
    case ViewDashboard = 'view_dashboard';
}
