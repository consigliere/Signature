<?php
/**
 * ServiceUnavailableHttpException.php
 * Created by @anonymoussc on 06/15/2019 8:58 PM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 6/17/19 3:30 PM
 */

namespace App\Components\Signature\Exceptions;

use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException as BaseServiceUnavailableHttpException;

class ServiceUnavailableHttpException extends BaseServiceUnavailableHttpException
{
    public function __construct($retryAfter = null, $message = null, \Throwable $previous = null, $code = 0, array $headers = ['Content-Type' => 'application/vnd.api+json',])
    {
        parent::__construct($retryAfter, $message, $previous, $code, $headers);
    }
}