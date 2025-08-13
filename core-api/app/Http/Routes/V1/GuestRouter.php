<?php

namespace App\Http\Routes\V1;

use App\Http\Controllers\GuestController;
use App\Http\Routes\RouteRegistrar;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class GuestRouter implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['api'])
            ->prefix('api/v1/guest')
            ->group(fn () => $this->routes());
    }

    public function routes(): void
    {
        Route::post('/', [GuestController::class, 'registerGuest']);
    }
}
