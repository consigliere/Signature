<?php
/**
 * UnprocessableEntityHttpException.php
 * Created by @anonymoussc on 06/17/2019 1:01 AM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 6/17/19 3:30 PM
 */

namespace App\Components\Signature\Exceptions;

use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException as BaseUnprocessableEntityHttpException;

class UnprocessableEntityHttpException extends BaseUnprocessableEntityHttpException
{
    public function __construct($message = null, \Throwable $previous = null, $code = 0, array $headers = ['Content-Type' => 'application/vnd.api+json',])
    {
        parent::__construct($message, $previous, $code, $headers);
    }
}