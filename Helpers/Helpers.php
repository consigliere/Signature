<?php
/**
 * Helper.php
 * Created by @anonymoussc on 05/21/2019 10:38 AM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/10/19 6:14 AM
 */

if (!function_exists('randomUuid')) {

    /**
     * @return string
     */
    function randomUuid()
    {
        return (string)\Webpatser\Uuid\Uuid::generate(4);
    }
}

if (!function_exists('httpStatusCode')) {

    /**
     * @param $e
     *
     * @return int
     */
    function httpStatusCode($e)
    {
        return method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
    }
}