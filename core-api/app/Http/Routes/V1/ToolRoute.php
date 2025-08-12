<?php

namespace App\Http\Routes\V1;

use App\Http\Controllers\AlarmController;
use App\Http\Controllers\ToolController;
use App\Http\Routes\RouteRegistrar;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class ToolRoute implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['api', 'auth:sanctum'])
            ->prefix('api/v1/tools')
            ->group(fn () => $this->routes());

        Route::middleware(['api'])
            ->prefix('api/v1/tools')
            ->group(function () {
                Route::post('/auth', [ToolController::class, 'authorizeTool']);
            });
    }

    private function routes(): void
    {
        Route::get('/my', [ToolController::class, 'myTools']);
        Route::post('/register', [ToolController::class, 'registerTool']);
        Route::get('/{id}/preferences', [ToolController::class, 'getPreferences']);
        Route::get('/tools/{id}/settings', [ToolController::class, 'getSettings']);
        Route::put('/{id}/settings', [ToolController::class, 'setSettings']);

        Route::prefix('/{tool_id}/alarms')->group(function () {
            Route::get('/', [AlarmController::class, 'list']);
            Route::post('/delete', [AlarmController::class, 'delete']);
        });
    }
}
