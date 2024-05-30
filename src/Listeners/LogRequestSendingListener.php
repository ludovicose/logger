<?php

declare(strict_types=1);

namespace Ludovicose\Logger\Listeners;

use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Support\Facades\Log;

class LogRequestSendingListener
{
    /**
     * Handle the event.
     */
    public function handle(RequestSending $event): void
    {
        $config = config('logger.enable_http_log', false);

        if (!$config) {
            return;
        }

        $id = app()->make('sequence-uuid');

        Log::info("HTTP Client Request: $id {$event->request->url()}", [
            'url'          => $event->request->url(),
            'method'       => $event->request->method(),
            'full_message' => $event->request->body(),
        ]);
    }
}
