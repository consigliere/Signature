<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 4/25/19 5:04 PM
 */

namespace App\Components\Signature\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AcceptJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $headers = request()->headers->all();

        if (!isset($headers['Accept']) || $headers['Accept'] !== 'application/vnd.api+json') {
            $request->headers->set("Accept", "application/vnd.api+json");
        }

        return $next($request);
    }
}
