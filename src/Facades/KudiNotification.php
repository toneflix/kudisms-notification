<?php

namespace ToneflixCode\KudiSmsNotification\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ToneflixCode\KudiSmsNotification\KudiNotification
 */
class KudiNotification extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ToneflixCode\KudiSmsNotification\KudiNotification::class;
    }
}
