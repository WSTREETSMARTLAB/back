<?php

namespace App\Http\Routes\V1;

use App\Http\Controllers\UserController;
use App\Http\Routes\RouteRegistrar;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class UserRouter implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['api', 'auth:sanctum'])
            ->prefix('api/v1/users')
            ->group(fn () => $this->routes());
    }

    private function routes(): void
    {
        Route::get('/me', [UserController::class, 'showMe']);
        Route::put('/account', [UserController::class, 'updateMyAccount']);
        Route::delete('/account', [UserController::class, 'deleteMyAccount']);
    }
}
