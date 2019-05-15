<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 5/15/19 9:21 PM
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

    /**
     * @param callable $reform
     * @param array    $data
     * @param array    $option
     * @param array    $param
     *
     * @return array
     */
    public function reform(Callable $reform, array $data = [], array $option = [], $param = []): array
    {
        return $reform($data, $option, $param);
    }

    /**
     * @param callable $response
     * @param          $dataObj
     * @param array    $option
     * @param array    $param
     *
     * @return array
     */
    public function transform(Callable $response, $dataObj, array $option = [], array $param = []): array
    {
        return $response($dataObj, $option, $param);
    }
}