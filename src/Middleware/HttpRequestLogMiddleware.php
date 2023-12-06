<?php

declare(strict_types=1);

namespace Ludovicose\Logger\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HttpRequestLogMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $id        = app()->make('sequence-uuid');
        $startTime = microtime(true);

        Log::info("WEB Request: $id {$request->url()}", [
            'url'       => $request->url(),
            'method'    => $request->method(),
            'headers'   => $request->headers->all(),
            'body'      => $request->all(),
            'ip'        => $request->ip(),
            'startTime' => $startTime,
        ]);

        $response = $next($request);

        Log::info("WEB Response: $id {$request->url()}", [
            'status_code' => $response->getStatusCode(),
            'body'        => $response->getContent(),
            'endTime'     => round(microtime(true) - $startTime, 2)
        ]);

        return $response;
    }
}
