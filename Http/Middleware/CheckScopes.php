<?php
/**
 * CheckScopes.php
 * Created by @anonymoussc on 07/10/2019 6:25 AM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/10/19 6:25 AM
 */

namespace App\Components\Signature\Http\Middleware;

use App\Components\Signal\Shared\Signal;
use App\Components\Signature\Exceptions\AccessDeniedHttpException;
use App\Components\Signature\Exceptions\UnauthorizedHttpException;

class CheckScopes
{
    use Signal;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  mixed                    ...$scopes
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\AuthenticationException|\Laravel\Passport\Exceptions\MissingScopeException
     */
    public function handle($request, $next, ...$scopes)
    {
        try {
            if (!$request->user() || !$request->user()->token()) {
                throw new AccessDeniedHttpException('Access denied');
            }

            foreach ($scopes as $scope) {
                if (!$request->user()->tokenCan($scope)) {
                    throw new UnauthorizedHttpException('Invalid scope(s) provided.');
                }
            }

            return $next($request);
        } catch (\Exception $error) {
            $euuid = randomUuid();
            $this->fireLog('error', $error->getMessage(), ['error' => $error, 'uuid' => $euuid]);

            return response()->ApiError($euuid, $error);
        }
    }
}
