<?php

namespace Cirelramos\Logs\Providers;

use Cirelramos\Logs\Services\QueryLogService;
use Cirelramos\Logs\Services\QueryRecordLogService;
use Cirelramos\Logs\Services\SendLogConsoleService;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

/**
 *
 */
class QueryLogProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        DB::listen(static function ($query) {
            QueryLogService::execute($query);
        });

        DB::beforeExecuting(static function ($query, $bindings) {
            QueryRecordLogService::execute($query, $bindings);
        });

    }
}
