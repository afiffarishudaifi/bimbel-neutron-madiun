<?php
namespace Alza\Alza_menu\Facades;
use Illuminate\Support\Facades\Facade;

class Menu extends Facade {
    /**
     * Return facade accessor
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}
