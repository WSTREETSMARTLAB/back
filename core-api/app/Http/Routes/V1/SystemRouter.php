<?php

namespace App\Http\Routes\V1;

use App\Http\Routes\RouteRegistrar;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class SystemRouter implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::prefix('api/v1')
            ->group(function () {
                Route::get('/health-check', function () {
                    return response()->json([
                        'message' => 'V1 Server is ready to use'
                    ], 200);
                });
            });
    }
}
