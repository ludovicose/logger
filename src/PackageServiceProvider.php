<?php

declare(strict_types=1);

namespace Ludovicose\Logger;

use Illuminate\Log\LogManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Ludovicose\Logger\Middleware\HttpRequestLogMiddleware;
use Ludovicose\Logger\Processors\AddSequenceProcessor;
use Ludovicose\Logger\Providers\EventServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'logger');

        $this->app->register(EventServiceProvider::class);

        $this->app->singleton('sequence-uuid', function () {
            return Str::uuid()->toString();
        });
    }

    public function boot()
    {
        /** @var LogManager $logger */
        $logger = app(LogManager::class);
        $logger->pushProcessor(new AddSequenceProcessor());

        $middlewareGroups = config('logger.middleware_groups');

        foreach ($middlewareGroups as $middlewareGroup) {
            $this->app->router->pushMiddlewareToGroup($middlewareGroup, HttpRequestLogMiddleware::class);
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('logger.php'),
            ], 'config');
        }
    }
}
