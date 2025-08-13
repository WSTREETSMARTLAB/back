<?php

namespace App\Domain\Company\Repositories;

use App\Domain\Company\Models\Company;
use App\System\Abstract\Repository;

class CompanyRepository extends Repository
{
    protected string $model = Company::class;
}
