<?php

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

interface RouteRegistrar
{
    public function map(Registrar $registrar): void;
}
