<?php

namespace App\Providers;

use App\Http\Routes\RouteRegistrar;
use App\Http\Routes\V1\AuthRoute;
use App\Http\Routes\V1\SystemRoute;
use App\Http\Routes\V1\ToolRoute;
use App\Http\Routes\V1\UserRoute;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected array $registrars = [
        AuthRoute::class,
        UserRoute::class,
        ToolRoute::class,
        SystemRoute::class
    ];

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            $this->mapRoutes(app(Registrar::class));
        });
    }

    private function mapRoutes(Registrar $router): void
    {
        foreach ($this->registrars as $registrar) {
            if (! class_exists($registrar) || ! is_subclass_of($registrar, RouteRegistrar::class)) {
                throw new \RuntimeException(
                    sprintf(
                        'Cannot map routes \'%s\', it is not a valid routes class',
                        $registrar
                    )
                );
            }

            (new $registrar)->map($router);
        }
    }
}
