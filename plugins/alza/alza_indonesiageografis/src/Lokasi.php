<?php

namespace Alza\Alza_indonesiageografis;

use Alza\Alza_indonesiageografis\Models\Provinces;
use Illuminate\Http\Request;

class Lokasi {

    public static function render(array $arr = []){
        $provinces = Provinces::all();
        $var = $arr;
        return view('location::location',compact('provinces','var'));
    }

    public static function scripts()
    {
        return view('location::script');
    }

    public static function scriptsedit(array $arr = [])
    {
        $var = $arr;
        return view('location::scriptedit',compact('var'));
    }

    public static function css()
    {
        return view('location::script');
    }
}
