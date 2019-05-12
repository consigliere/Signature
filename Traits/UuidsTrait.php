<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 5/12/19 7:47 AM
 */

/**
 * UuidsTrait.php
 * Created by @anonymoussc on 05/12/2019 2:13 AM.
 */

namespace App\Components\Signature\Traits;

use Webpatser\Uuid\Uuid;

/**
 * Trait UuidsTrait
 * @package App\Components\Signature\Traits
 */
trait UuidsTrait
{
    public static function boot()
    {
        parent::boot();
        self::creating(function($model) {
            $model->uuid = (string)Uuid::generate(4);
        });
    }
}