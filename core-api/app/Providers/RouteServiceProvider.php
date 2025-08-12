<?php

namespace App\Providers;

use App\Http\Routes\RouteRegistrar;
use App\Http\Routes\V1\AuthRouter;
use App\Http\Routes\V1\SystemRouter;
use App\Http\Routes\V1\ToolRouter;
use App\Http\Routes\V1\UserRouter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected array $routers = [
        AuthRouter::class,
        UserRouter::class,
        ToolRouter::class,
        SystemRouter::class
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
            $this->mapRouters(app(Registrar::class));
        });
    }

    private function mapRouters(Registrar $registrar): void
    {
        foreach ($this->routers as $router) {
            if (! class_exists($router) || ! is_subclass_of($router, RouteRegistrar::class)) {
                throw new \RuntimeException(
                    sprintf(
                        'Cannot map routes \'%s\', it is not a valid routes class',
                        $router
                    )
                );
            }

            (new $router)->map($registrar);
        }
    }
}
