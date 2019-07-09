<?php
/**
 * UnauthorizedHttpException.php
 * Created by @anonymoussc on 07/06/2019 6:39 PM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/6/19 6:40 PM
 */

namespace App\Components\Signature\Exceptions;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException as BaseUnauthorizedHttpException;

class UnauthorizedHttpException extends BaseUnauthorizedHttpException
{
    public function __construct($message = null, \Exception $previous = null, $code = 0, array $headers = ['Content-Type' => 'application/vnd.api+json',])
    {
        parent::__construct('', $message, $previous, $code, $headers);
    }
}