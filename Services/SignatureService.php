<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 5/3/19 2:49 AM
 */

/**
 * SignatureService.php
 * Created by @anonymoussc on 05/03/2019 2:46 AM.
 */

namespace App\Components\Signature\Services;


/**
 * Class SignatureService
 * @package App\Components\Signature\Services
 */
class SignatureService
{
    /**
     * @param $params
     * @param $key
     *
     * @return mixed
     */
    public function getKeys($params, $key)
    {
        foreach ($params as $val) {
            if (isset($val[$key])) {
                return $val[$key];
            }
        }
    }
}