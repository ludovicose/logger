<?php

declare(strict_types=1);

namespace Ludovicose\Logger\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Ludovicose\Logger\Listeners\LogConnectionFailedListener;
use Ludovicose\Logger\Listeners\LogEloquentEventListener;
use Ludovicose\Logger\Listeners\LogQueryListener;
use Ludovicose\Logger\Listeners\LogRequestSendingListener;
use Ludovicose\Logger\Listeners\LogResponseReceivedListener;

final class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Illuminate\Http\Client\Events\ResponseReceived' => [
            LogResponseReceivedListener::class,
        ],
        'Illuminate\Http\Client\Events\RequestSending'   => [
            LogRequestSendingListener::class,
        ],
        'Illuminate\Http\Client\Events\ConnectionFailed' => [
            LogConnectionFailedListener::class,
        ],
        'eloquent.created'                               => [
            LogEloquentEventListener::class
        ],
        'eloquent.updated'                               => [
            LogEloquentEventListener::class
        ],
        'eloquent.deleted'                               => [
            LogEloquentEventListener::class
        ],
        'Illuminate\Database\Events\QueryExecuted'       => [
            LogQueryListener::class,
        ]
    ];
}
