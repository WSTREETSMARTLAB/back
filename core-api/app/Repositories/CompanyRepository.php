<?php

namespace App\Repositories;

use App\Domain\Company\Models\Company;

class CompanyRepository extends Repository
{
    protected string $model = Company::class;
}
