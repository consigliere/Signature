<?php
/**
 * CheckAcceptHttpHeader.php
 * Created by @anonymoussc on 07/09/2019 2:12 AM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/9/19 2:53 AM
 */

namespace App\Components\Signature\Http\Middleware;

use App\Components\Signal\Shared\Signal;
use App\Components\Signature\Exceptions\NotAcceptableHttpException;
use Closure;
use Illuminate\Http\Request;

class CheckAcceptHttpHeader
{
    use Signal;

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
        try {
            $headers = request()->headers->all();

            if (!isset($headers['accept'])) {
                throw new NotAcceptableHttpException('HTTP Request Accept header are required');
            } else {
                if (!in_array('application/vnd.api+json', $headers['accept'], true)) {
                    throw new NotAcceptableHttpException('Not Acceptable value in HTTP request Accept header');
                }
            }
        } catch (\Exception $error) {
            $euuid = randomUuid();
            $this->fireLog('error', $error->getMessage(), ['error' => $error, 'uuid' => $euuid]);

            return response()->ApiError($euuid, $error);
        }

        return $next($request);
    }
}
