<?php

Route::group(['middleware' => 'web', 'prefix' => 'signature', 'namespace' => 'App\\Components\Signature\Http\Controllers'], function () {
    Route::get('/', 'SignatureController@index');
});
