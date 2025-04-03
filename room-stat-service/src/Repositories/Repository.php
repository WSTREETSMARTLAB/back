<?php

namespace App\Repositories;

use PDO;

class Repository
{
    public function __construct(protected PDO $db)
    {
    }
}
