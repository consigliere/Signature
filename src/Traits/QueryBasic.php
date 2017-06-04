<?php
/**
 * QueryBasic.php
 * Created by anonymoussc on 1/16/2017 12:33 AM.
 */

namespace App\Components\Signature\Traits;

use Illuminate\Support\Facades\DB;

trait QueryBasic
{
    /**
     * @param array $condition
     * @param array $param
     *
     * @return array
     */
    public function _all(array $condition = [], array $param = [])
    {
        try {
            $table = (isset($param['table'])) ? $param['table'] : '';

            if (!empty($condition)) {
                $construct = DB::table($table)->where($condition)->orderBy('id', 'desc');
                $records   = $construct->get();
            } else {
                $construct = DB::table($table)->orderBy('id', 'desc');
                $records   = $construct->get();
            }
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
     * @param array $data
     * @param array $param
     *
     * @return array
     */
    public function store(array $data, array $param = [])
    {
        try {
            $table   = (isset($param['table'])) ? $param['table'] : '';
            $records = DB::table($table)->insert($data);
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
     * @param array $data
     * @param array $param
     *
     * @return array
     */
    public function storedGetId(array $data, array $param = [])
    {
        try {
            $table   = (isset($param['table'])) ? $param['table'] : '';
            $records = DB::table($table)->insertGetId($data);
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
     * @param array $condition
     * @param array $param
     *
     * @return array
     */
    public function edit(array $condition, array $param = [])
    {
        try {
            $table     = (isset($param['table'])) ? $param['table'] : '';
            $construct = DB::table($table)->where($condition);
            $records   = $construct->get();
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
     * @param array $condition
     * @param array $data
     * @param array $param
     *
     * @return array|bool
     */
    public function alter(array $condition, array $data, array $param = [])
    {
        try {
            $table = (isset($param['table'])) ? $param['table'] : '';
            DB::table($table)->where($condition)->update($data);
        } catch (\Exception $e) {
            $records = [
                'status' => false,
                'e'      => $e,
            ];

            return $records;
        }

        return true;
    }

    /**
     * @param array $condition
     * @param array $param
     *
     * @return array|bool
     */
    public function destruct(array $condition, array $param = [])
    {
        try {
            $table = (isset($param['table'])) ? $param['table'] : '';
            DB::table($table)->where($condition)->delete();
        } catch (\Exception $e) {
            $records = [
                'status' => false,
                'e'      => $e,
            ];

            return $records;
        }

        return true;
    }

    /**
     * @param       $table
     * @param       $request
     * @param array $param
     *
     * @return array|bool
     */
    public function destruction($table, $request, array $param = [])
    {
        try {
            for ($i = 0; $i < count($request->id); $i++) {
                $id = $request->id[$i];
                DB::table($table)->where('id', $id)->delete();
            }
        } catch (\Exception $e) {
            $records = [
                'status' => false,
                'e'      => $e,
            ];

            return $records;
        }

        return true;
    }

    /**
     * @param array $param
     *
     * @return string
     */
    private function debugMessage(array $param = [])
    {
        $query   = (isset($param['construct'])) ? $param['construct']->toSql() : 'NA';
        $count   = (isset($param['construct'])) ? $param['construct']->count() : 'NA';
        $table   = (isset($param['table'])) ? $param['table'] : 'NA';
        $message = 'Success get all/ get for editing data from ' . $table . ' table, count records "' . $count . '", with query : "' . $query . '"';

        return $message;
    }

    /**
     * @param array $param
     *
     * @return string
     */
    private function infoMessage(array $param = [])
    {
        $query   = (isset($param['construct'])) ? $param['construct']->toSql() : 'NA';
        $count   = (isset($param['construct'])) ? $param['construct']->count() : 'NA';
        $table   = (isset($param['table'])) ? $param['table'] : 'NA';
        $data    = (isset($param['data'])) ? $this->sanitizeImgBlob($param['data']) : 'NA';
        $message = 'Success input/ update data into ' . $table . ' table, with data values (' . (implode(", ", $data)) . ')';

        return $message;
    }

    /**
     * @param array $param
     *
     * @return string
     */
    private function sanitizeImgBlob(array $param = [])
    {
        if (array_key_exists('images_blob', $param)) {
            $param['images_blob'] = str_limit($param['images_blob'], 11);
            if (array_key_exists('description', $param)) {
                $param['description'] = strip_tags($param['description']);
            }
        }

        return $param;
    }
}