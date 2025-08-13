<?php

namespace App\System\Enums;

enum Permission: string
{
    // Управление пользователями
    case ManageUsers = 'manage_users';  // Создание, редактирование, удаление пользователей
    case ViewUsers = 'view_users';      // Просмотр списка пользователей

    // Управление компаниями
    case ManageCompanies = 'manage_companies'; // Создание, редактирование, удаление компаний
    case ViewCompanies = 'view_companies';     // Просмотр списка компаний

    // Доступ к аналитике / дашборду
    case ViewDashboard = 'view_dashboard';     // Просмотр аналитики
}
