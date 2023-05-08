<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

class EnsureJsonMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!$request->isJson()) {
            throw new NotAcceptableHttpException('Only application/json content type is allowed.');
        }

        return $next($request);
    }
}
