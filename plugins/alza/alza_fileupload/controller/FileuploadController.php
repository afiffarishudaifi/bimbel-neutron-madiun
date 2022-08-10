<?php

namespace App\Http\Controllers\Service;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileuploadController extends Controller
{
    function upload_data(Request $request)
	{

        $file               = $request->file('filenames');
        $file_uploaded_name = $file->getClientOriginalName();
        if (file_exists($file)) {
            $ret = array();
            $pathfile = Storage::putFileAs(
                'public/product',
                $request->file('filenames'),
                time()."_".$file_uploaded_name,
            );
            $ret[] = array("filename"=>time()."_".$file_uploaded_name,"message"=>"Data berhasil diupload","success"=>200);
            return response()->json($ret);
        }
	}

	function delete_data(Request $request)
	{
        $file_path = str_replace('\\','/',base_path()).'/public'.Storage::url('product/').$request->filename;
        if (file_exists($file_path)) {
            unlink($file_path);
            return $request->filename;
        }
	}
}
