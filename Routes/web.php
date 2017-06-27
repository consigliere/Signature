<?php
/**
 * web.php
 * Created by @anonymoussc on 6/27/2017 12:50 PM.
 */

Route::group(['middleware' => 'web', 'prefix' => 'signature', 'namespace' => 'App\\Components\Signature\Http\Controllers'], function () {
    Route::get('/', 'SignatureController@index');
});