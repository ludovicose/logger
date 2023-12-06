<?php

declare(strict_types=1);

namespace Ludovicose\Logger\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LogEloquentEventListener
{
    public function handle($event, array $models)
    {
        if (Str::contains($event, ['booting', 'booted', 'creating', 'updating', 'deleting', 'saving'])) {
            return;
        }

        $config = config('logger.enable_eloquent_log', false);

        if (!$config) {
            return;
        }

        $id = app()->make('sequence-uuid');

        foreach ($models as $model) {
            Log::info("Eloquent: $id", [
                'id'    => $model->id,
                'body'  => $model->toJson(),
                'event' => $event,
                'model' => $model::class
            ]);
        }
    }
}
