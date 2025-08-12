<?php

namespace App\Http\Routes\V1;

use App\Http\Controllers\AuthController;
use App\Http\Routes\RouteRegistrar;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AuthRoute implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['api'])
            ->prefix('api/v1/auth')
            ->group(fn () => $this->routes());

        Route::middleware(['api', 'sanctum'])
            ->prefix('api/v1/auth')
            ->group(function () {
                Route::get('/logout', [AuthController::class, 'logout']);
            });
    }

    private function routes(): void
    {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/verify', [AuthController::class, 'verify']);
        Route::get('/resend-email-verification', [AuthController::class, 'resend']);
    }
}
