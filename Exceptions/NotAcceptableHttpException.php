<?php
/**
 * NotAcceptableHttpException.php
 * Created by @anonymoussc on 06/15/2019 8:57 PM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 6/17/19 3:30 PM
 */

namespace App\Components\Signature\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException as BaseNotAcceptableHttpException;

class NotAcceptableHttpException extends BaseNotAcceptableHttpException
{
    public function __construct($message = null, \Throwable $previous = null, $code = 0, array $headers = ['Content-Type' => 'application/vnd.api+json',])
    {
        parent::__construct($message, $previous, $code, $headers);
    }
}