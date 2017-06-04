<?php
/**
 * PaginationResponseMacroServiceProvider.php
 * Created by @rn on 12/16/2016 3:09 PM.
 */

namespace App\Components\Signature\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class PaginationResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('withPaging',
            function(array $data = [], $page = 0, $limit = 0, $total = 0, array $lists = [], $path = '', array $param = []) {

                if (!empty($data)) {
                    extract($data);
                }

                $pageTotal     = ceil($total / $limit);
                $pageIncrement = abs($page + 1);
                $pageDecrement = abs($page - 1);
                $listCount     = count($lists);

                return Response::json([
                    'total'        => $total,
                    'per_page'     => $limit,
                    'current_page' => $page,
                    'last_page'    => $pageTotal,
                    'first_page'   => 1,
                    'next_page'    => ($page + 1),
                    'prev_page'    => (($pageDecrement == 0) ? 1 : $pageDecrement),
                    'link'         => [
                        'last_page_url'    => config('app.url') . '/' . $path . '/limit/' . $limit . "/page/" . $pageTotal,
                        'first_page_url'   => config('app.url') . '/' . $path . '/limit/' . $limit . "/page/" . 1,
                        'current_page_url' => config('app.url') . '/' . $path . '/limit/' . $limit . "/page/" . $page,
                        'next_page_url'    => config('app.url') . '/' . $path . '/limit/' . $limit . "/page/" . (($pageIncrement >= $pageTotal) ? $pageTotal : $pageIncrement),
                        'prev_page_url'    => config('app.url') . '/' . $path . '/limit/' . $limit . "/page/" . (($pageDecrement == 0) ? 1 : $pageDecrement),
                    ],
                    'from'         => ($pageDecrement * $limit),
                    'to'           => (($pageDecrement * $limit) + $listCount),
                    'status'       => ($listCount > 0) ? 1 : 0,
                    'count'        => $listCount,
                    'msg'          => "Found " . $listCount . " data ",
                    'result'       => $lists,
                ]);
            }
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}