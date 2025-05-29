<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;

trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication(): Application
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $this->checkDatabaseName();
        $this->refreshDatabase();

        return $app;
    }

    private function checkDatabaseName(): void
    {
        if (DB::connection()->getDatabaseName() !== "w5smtlab_test") {
            $this->clearCache();
        }
    }

    private function refreshDatabase(): void
    {
        \Artisan::call('optimize:clear');
        \Artisan::call('migrate:fresh', ['--database' => 'mysql_unit_test']);
        \Artisan::call('db:seed', ['--database' => 'mysql_unit_test']);
    }

    private function clearCache(): void
    {
        $commands = ['clear-compiled', 'cache:clear', 'view:clear', 'config:clear', 'route:clear'];

        foreach ($commands as $command) {
            \Illuminate\Support\Facades\Artisan::call($command);
        }
    }
}
