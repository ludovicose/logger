<?php

namespace Ludovicose\Logger\Listeners;

use Illuminate\Http\Client\Events\ConnectionFailed;
use Illuminate\Support\Facades\Log;

class LogConnectionFailedListener
{
    /**
     * Handle the event.
     */
    public function handle(ConnectionFailed $event): void
    {
        $config = config('logger.enable_http_log', false);

        if (!$config) {
            return;
        }

        $id = app()->make('sequence-uuid');

        Log::info("Connection failed: $id {$event->request->url()}", [
            'url'    => $event->request->url(),
            'method' => $event->request->method(),
            'body'   => $event->request->body(),
        ]);
    }
}
