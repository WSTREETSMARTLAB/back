<?php

namespace App\Domain\Profile\Enums;

use App\Domain\Company\Models\Company;
use App\Domain\User\Models\User;
use App\System\Traits\BaseEnum;

enum ProfileType: string
{
    use BaseEnum;

    case USER = User::class;
    case COMPANY = Company::class;
}
