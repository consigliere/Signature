<?php
/**
 * Copyright(c) 2019. All rights reserved.
 * Last modified 5/12/19 2:12 AM
 */

/**
 * ConfigurableUuidsTrait.php
 * Created by @anonymoussc on 05/11/2019 5:23 PM.
 */

namespace App\Components\Signature\Traits;

use Webpatser\Uuid\Uuid;

/**
 * Trait ConfigurableUuidsTrait
 * @package App\Components\Signature\Traits
 */
trait ConfigurableUuidsTrait
{
    /**
     *  Setup model event hooks
     */
    public static function bootUuids()
    {
        static::saving(function($model) {
            $config      = $model->setUuid($model);
            $model->uuid = (string)Uuid::generate(4);
        });
    }

    /**
     * @param $entity
     *
     * @return array
     */
    abstract public function setUuid($entity): array;
}