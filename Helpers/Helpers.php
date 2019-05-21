<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 5/21/19 12:44 PM
 */

/**
 * Helper.php
 * Created by @anonymoussc on 05/21/2019 10:38 AM.
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