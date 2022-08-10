<?php
namespace Alza\Alza_fileupload;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Fileupload {

    public static function addrender($tagname = ''){
        $name = empty($tagname) ? config('fileuploader.name') : $tagname;
        return view('fileuploader::addupload',compact('name'));
    }

    public static function editrender($tagname = '',$file){
        $name = empty($tagname) ? config('fileuploader.name') : $tagname;
        $var = $file;
        return view('fileuploader::editupload',compact('name','var'));
    }

    public static function styles(){
        return view('fileuploader::styles');
    }

    public static function script($maxs='', $allows='', $sizes=''){
        $max = empty($maxs) ? config('fileuploader.max') : $maxs ;
        $allow = empty($allows) ? config('fileuploader.allow') : $allows ;
        $size = empty($sizes) ? config('fileuploader.size') : $sizes ;
        return view('fileuploader::scripts',compact('max','allow','size'));
    }

    public static function remove($filefix,$fileremove,$table,$id){
        foreach(explode(',',rtrim($fileremove,',')) as $file){
            Storage::disk('public')->delete(config('fileuploader.path').'/'.$file);
            DB::table($table)
                ->where('id', $id)
                ->update([config('fileuploader.name') => $filefix]);
        }
    }
}
