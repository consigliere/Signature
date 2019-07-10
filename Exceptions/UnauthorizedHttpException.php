<?php
/**
 * UnauthorizedHttpException.php
 * Created by @anonymoussc on 07/06/2019 6:39 PM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/10/19 6:33 AM
 */

namespace App\Components\Signature\Exceptions;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException as BaseUnauthorizedHttpException;

class UnauthorizedHttpException extends BaseUnauthorizedHttpException
{
    public function __construct($message = null, \Exception $previous = null, $code = 0, array $headers = [])
    {
        $headers = empty($headers) ? ['Content-Type' => 'application/vnd.api+json',] : $headers;

        parent::__construct('', $message, $previous, $code, $headers);
    }
}