<?php
/**
 * ServiceUnavailableHttpException.php
 * Created by @anonymoussc on 06/15/2019 8:58 PM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/10/19 6:33 AM
 */

namespace App\Components\Signature\Exceptions;

use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException as BaseServiceUnavailableHttpException;

class ServiceUnavailableHttpException extends BaseServiceUnavailableHttpException
{
    public function __construct($retryAfter = null, $message = null, \Throwable $previous = null, $code = 0, array $headers = [])
    {
        $headers = empty($headers) ? ['Content-Type' => 'application/vnd.api+json',] : $headers;

        parent::__construct($retryAfter, $message, $previous, $code, $headers);
    }
}