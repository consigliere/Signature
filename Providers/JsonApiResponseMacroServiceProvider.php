<?php
/**
 * JsonApiResponseMacroServiceProvider.php
 * Created by @anonymoussc on 04/24/2019 12:06 PM.
 */

/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 7/11/19 6:01 PM
 */

namespace App\Components\Signature\Providers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use JsonSerializable;

class JsonApiResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('Api', function($data, $statusCode = 200, array $headers = [], $options = 0, array $param = []) {
            $headers = empty($headers) ? ['Content-Type' => 'application/vnd.api+json',] : $headers;
            $options = 0 === $options ? JSON_UNESCAPED_SLASHES : $options;

            if ($data instanceof Arrayable && !$data instanceof JsonSerializable) {
                $data = $data->toArray();
            }

            return new JsonResponse($data, $statusCode, $headers, $options);
        });

        Response::macro('ApiSuccess', function($data, array $param = []) {
            return Response::json([]);
        });

        Response::macro('ApiFail', function($data = null, array $param = []) {
            return Response::json([]);
        });

        Response::macro('ApiError', function($id, $error, $statusCode = 500, array $headers = [], $options = 0, array $param = []) {
            $headers    = empty($headers) ? ['Content-Type' => 'application/vnd.api+json',] : $headers;
            $options    = 0 === $options ? JSON_UNESCAPED_SLASHES : $options;
            $request    = App::get('request');
            $year       = date('Y');
            $name       = config('app.name') ?? 'all right reserved';
            $statusCode = method_exists($error, 'getStatusCode') ? $error->getStatusCode() : $statusCode;

            $err['error']['id'] = $id;

            if ($error instanceof \Exception) {

                $err['error']['status'] = (string)$statusCode;
                $err['error']['code']   = (string)$error->getCode();
                $err['error']['title']  = $error->getMessage();

                if (config('app.env') !== 'production') {
                    $err['error']['source']['file'] = $error->getFile();
                    $err['error']['source']['line'] = $error->getLine();
                    $err['error']['detail']         = $error->getTraceAsString();
                }
            }

            $err['links']['self'] = $request->fullUrl();
            $err['meta']          = [
                'copyright' => "copyrightⒸ $year $name",
                'authors'   => config('user.api.authors'),
            ];

            return new JsonResponse($err, $statusCode, $headers, $options);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}