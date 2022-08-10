<?php

namespace Alza\Alza_crud\Facades;

use Illuminate\Support\Facades\Facade;

class Crud extends Facade {
    /**
     * Return facade accessor
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'azcrud';
    }
}
