<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/10/19 6:15 AM
 */

namespace App\Components\Signature\Http\Controllers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use InvalidArgumentException;
use JsonSerializable;
use Optimus\Architect\Architect;

/**
 * Class SignatureController
 * @package App\Components\Signature\Http\Controllers
 */
class SignatureController extends Controller
{
    /**
     * @var array
     */
    protected $defaults = [];

    /**
     * Create a json response
     *
     * @param       $data
     * @param int   $statusCode
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response($data, $statusCode = 200, array $headers = []): JsonResponse
    {
        if ($data instanceof Arrayable && !$data instanceof JsonSerializable) {
            $data = $data->toArray();
        }

        return new JsonResponse($data, $statusCode, $headers);
    }

    /**
     * @param       $data
     * @param array $options
     * @param null  $key
     *
     * @return array
     */
    protected function parseData($data, array $options, $key = null): array
    {
        $architect = new Architect();

        return $architect->parseData($data, $options['modes'], $key);
    }

    /**
     * Page sort
     *
     * @param array $sort
     *
     * @return array
     */
    protected function parseSort(array $sort): array
    {
        return array_map(function ($sort) {
            if (!isset($sort['direction'])) {
                $sort['direction'] = 'asc';
            }

            return $sort;
        }, $sort);
    }

    /**
     * Parse include strings into resource and modes
     *
     * @param array $includes
     *
     * @return array
     */
    protected function parseIncludes(array $includes): array
    {
        $return = [
            'includes' => [],
            'modes'    => [],
        ];

        foreach ($includes as $include) {
            $explode = explode(':', $include);

            if (!isset($explode[1])) {
                $explode[1] = $this->defaults['mode'];
            }

            $return['includes'][]         = $explode[0];
            $return['modes'][$explode[0]] = $explode[1];
        }

        return $return;
    }

    /**
     * @param array $filter_groups
     *
     * @return array
     */
    protected function parseFilterGroups(array $filter_groups): array
    {
        $return = [];

        foreach ($filter_groups as $group) {
            if (!array_key_exists('filters', $group)) {
                throw new InvalidArgumentException('Filter group does not have the \'filters\' key.');
            }

            $filters = array_map(function ($filter) {
                if (!isset($filter['not'])) {
                    $filter['not'] = false;
                }

                return $filter;
            }, $group['filters']);

            $return[] = [
                'filters' => $filters,
                'or'      => isset($group['or']) ? $group['or'] : false,
            ];
        }

        return $return;
    }

    /**
     * Parse GET parameters into resource options
     *
     * @param null $request
     *
     * @return array
     */
    protected function parseResourceOptions($request = null): array
    {
        if ($request === null) {
            $request = request();
        }

        $this->defaults = array_merge([
            'includes'      => [],
            'sort'          => [],
            'limit'         => null,
            'page'          => null,
            'mode'          => 'embed',
            'filter_groups' => [],
        ], $this->defaults);

        $includes      = $this->parseIncludes($request->get('includes', $this->defaults['includes']));
        $sort          = $this->parseSort($request->get('sort', $this->defaults['sort']));
        $limit         = $request->get('limit', $this->defaults['limit']);
        $page          = $request->get('page', $this->defaults['page']);
        $filter_groups = $this->parseFilterGroups($request->get('filter_groups', $this->defaults['filter_groups']));

        if ($page !== null && $limit === null) {
            throw new InvalidArgumentException('Cannot use page option without limit option');
        }

        return [
            'includes'      => $includes['includes'],
            'modes'         => $includes['modes'],
            'sort'          => $sort,
            'limit'         => $limit,
            'page'          => $page,
            'filter_groups' => $filter_groups,
        ];
    }

    /**
     * @deprecated
     *
     * @param       $id
     * @param       $errorObj
     * @param array $param
     *
     * @return array
     */
    protected function getErrorResponse($id, $errorObj, array $param = []): array
    {
        $request       = App::get('request');
        $errorResponse = [];

        data_set($errorResponse, 'error.id', $id);

        if ($errorObj instanceof \Exception) {
            $statusCode = method_exists($errorObj, 'getStatusCode') ? $errorObj->getStatusCode() : 500;

            data_set($errorResponse, 'error.status', (string)$statusCode);
            data_set($errorResponse, 'error.code', (string)$errorObj->getCode());
            data_set($errorResponse, 'error.title', $errorObj->getMessage());

            if (Config::get('app.env') !== 'production') {
                data_set($errorResponse, 'error.source.file', $errorObj->getFile());
                data_set($errorResponse, 'error.source.line', $errorObj->getLine());
                data_set($errorResponse, 'error.detail', $errorObj->getTraceAsString());
            }
        }

        data_set($errorResponse, 'links.self', $request->fullUrl());
        data_set($errorResponse, 'meta.copyright', 'copyrightⒸ ' . date('Y') . ' ' . Config::get('app.name'));
        data_set($errorResponse, 'meta.authors', Config::get('user.api.authors'));

        return $errorResponse;
    }
}
