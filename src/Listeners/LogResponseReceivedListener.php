<?php

namespace Ludovicose\Logger\Listeners;

use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Support\Facades\Log;

class LogResponseReceivedListener
{
    /**
     * Handle the event.
     */
    public function handle(ResponseReceived $event): void
    {
        $config = config('logger.enable_http_log', false);

        if (!$config) {
            return;
        }

        $id = app()->make('sequence-uuid');

        Log::info("HTTP Client Response: $id {$event->request->url()}", [
            'status_code' => $event->response->status(),
            'reason'      => $event->response->reason(),
            'body'        => $event->response->body(),
        ]);
    }
}
