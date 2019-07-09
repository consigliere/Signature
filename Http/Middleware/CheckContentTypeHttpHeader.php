<?php
/**
 * CheckContentType.php
 * Created by @anonymoussc on 05/14/2019 8:23 AM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/10/19 6:16 AM
 */

namespace App\Components\Signature\Http\Middleware;

use App\Components\Signal\Shared\Signal;
use App\Components\Signature\Exceptions\UnsupportedMediaTypeHttpException;
use Closure;
use Illuminate\Http\Request;

class CheckContentTypeHttpHeader
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

            if (!isset($headers['content-type'])) {
                throw new UnsupportedMediaTypeHttpException('HTTP Request Content-Type header are required');
            } else {
                if (!in_array('application/vnd.api+json', $headers['content-type'], true)) {
                    throw new UnsupportedMediaTypeHttpException('Unsupported Media Type in HTTP request Content-Type header');
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
