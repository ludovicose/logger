<?php

declare(strict_types=1);

namespace Ludovicose\Logger\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

final class LogQueryListener
{
    public function handle(QueryExecuted $event)
    {
        $config = config('logger.enable_query_log', false);

        if (!$config) {
            return;
        }

        $id = app()->make('sequence-uuid');

        $sql      = $event->sql;
        $bindings = $event->bindings;
        $time     = $event->time;

        Log::info("SQL Query: {$id}", [
            'sql'       => $sql,
            'bindings'  => json_encode($bindings),
            'time (ms)' => $time
        ]);
    }
}
