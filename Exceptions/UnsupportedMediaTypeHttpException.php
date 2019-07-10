<?php
/**
 * UnsupportedMediaTypeHttpException.php
 * Created by @anonymoussc on 06/30/2019 4:49 PM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/10/19 6:33 AM
 */

namespace App\Components\Signature\Exceptions;

use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException as BaseUnsupportedMediaTypeHttpException;

class UnsupportedMediaTypeHttpException extends BaseUnsupportedMediaTypeHttpException
{
    public function __construct($message = null, \Throwable $previous = null, $code = 0, array $headers = [])
    {
        $headers = empty($headers) ? ['Content-Type' => 'application/vnd.api+json',] : $headers;

        parent::__construct($message, $previous, $code, $headers);
    }
}