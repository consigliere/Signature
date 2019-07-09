<?php
/**
 * ConflictHttpException.php
 * Created by @anonymoussc on 06/30/2019 4:46 PM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 6/30/19 5:02 PM
 */

namespace App\Components\Signature\Exceptions;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException as BaseConflictHttpException;

class ConflictHttpException extends BaseConflictHttpException
{
    public function __construct($message = null, \Throwable $previous = null, $code = 0, array $headers = [])
    {
        parent::__construct($message, $previous, $code, $headers);
    }
}
