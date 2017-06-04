<?php
/**
 * Pagination.php
 * Created by @rn on 12/16/2016 2:57 PM.
 */

namespace App\Components\Signature\Traits;

use Illuminate\Support\Facades\DB;

trait Pagination
{
    /**
     * @param array $param
     *
     * @return array
     */
    protected function dataCount(array $param = [])
    {
        try {
            $table = (isset($param['table'])) ? $param['table'] : '';

            $records = DB::table($table)->count();
        } catch (\Exception $e) {
            $records = [
                'status' => false,
                'e'      => $e,
            ];

            return $records;
        }

        return $records;
    }

    /**
     * @param       $from
     * @param       $limit
     * @param array $param
     *
     * @return array
     */
    protected function dataLists($from, $limit, array $param = [])
    {
        try {
            $table = (isset($param['table'])) ? $param['table'] : '';

            $records = DB::table($table)->skip($from)->take($limit)->orderBy('id', 'desc')->get();
        } catch (\Exception $e) {
            $records = [
                'status' => false,
                'e'      => $e,
            ];

            return $records;
        }

        return $records;
    }

    /**
     * @param       $path
     * @param array $param
     *
     * @return string
     */
    private function requestPath($path, array $param = [])
    {
        $rpath = explode('/', $path);

        for ($i = 1; $i <= 4; $i++) {
            array_pop($rpath);
        }

        return $path = implode('/', $rpath);
    }

    /**
     * @param null $total
     * @param array $lists
     * @param array $param
     *
     * @return array
     */
    public function paginate($total = null, array $lists = [], array $param = [])
    {
        try {
            $request = (isset($param['request'])) ? $param['request'] : app('request');
            $limit   = (isset($param['limit'])) ? $param['limit'] : $request->limit;
            $page    = (isset($param['page'])) ? $param['page'] : $request->page;
            $uri     = (isset($param['uri'])) ? $param['uri'] : $request->path();
            $table   = (isset($param['table'])) ? $param['table'] : '';

            $records['limit'] = abs($limit);
            $records['page']  = abs($page);
            $records['total'] = (is_null($total)) ? $this->dataCount(['table' => $table]) : $total;
            $records['lists'] = (empty($lists)) ? $this->dataLists((($records['page'] - 1) * $records['limit']), $records['limit'], ['table' => $table]) : $lists;
            $records['path']  = $this->requestPath($uri);
        } catch (\Exception $e) {
            $records = [
                'status' => false,
                'e'      => $e,
            ];

            return $records;
        }

        return $records;
    }
}