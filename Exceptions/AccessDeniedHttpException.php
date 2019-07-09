<?php
/**
 * AccessDeniedHttpException.php
 * Created by @anonymoussc on 06/13/2019 7:17 PM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 6/13/19 11:52 PM
 */

namespace App\Components\Signature\Exceptions;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException as BaseAccessDeniedHttpException;

class AccessDeniedHttpException extends BaseAccessDeniedHttpException
{
    /**
     * @param string     $message  The internal exception message
     * @param \Throwable $previous The previous exception
     * @param int        $code     The internal exception code
     * @param array      $headers
     */
    public function __construct(string $message = null, \Throwable $previous = null, int $code = 0, array $headers = ['Content-Type' => 'application/vnd.api+json',])
    {
        parent::__construct($message, $previous, $code, $headers);
    }
}
