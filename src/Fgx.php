<?php

namespace Fgx;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Flux\FluxManager
 */
class Fgx extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'fgx';
    }
}
