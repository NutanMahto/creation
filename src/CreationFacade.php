<?php

namespace Linn\Creation;

use Illuminate\Support\Facades\Facade;

class CreationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'creation';
    }
}