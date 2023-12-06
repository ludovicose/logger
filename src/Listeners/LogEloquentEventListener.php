<?php

declare(strict_types=1);

namespace Ludovicose\Logger\Listeners;

use Illuminate\Support\Facades\Log;

class LogEloquentEventListener
{
    public function handle($event, array $models)
    {
        $config = config('logger.enable_eloquent_log', false);

        if (!$config) {
            return;
        }

        $id = app()->make('sequence-uuid');

        foreach ($models as $model) {
            Log::info("Eloquent: $id $event ", [
                'id'   => $model->id,
                'body' => $model->toJson(),
            ]);
        }
    }
}
