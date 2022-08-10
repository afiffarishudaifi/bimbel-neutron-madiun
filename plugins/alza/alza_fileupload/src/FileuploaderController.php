<?php

namespace Alza\Alza_fileupload;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileuploaderController extends Controller
{
    function upload_data(Request $request)
	{

        $file = $request->file('filenames');
        $file_uploaded_name = $file->getClientOriginalName();
        if (file_exists($file)) {
            $ret = array();
            $pathfile = Storage::putFileAs(
                'public'.'/'. config('fileuploader.path'),
                $request->file('filenames'),
                time()."_".$file_uploaded_name,
            );
            $ret[] = array("filename"=>basename($pathfile),"message"=>"Data berhasil diupload","success"=>200);
            return response()->json($ret);
        }
	}

	function delete_data(Request $request)
	{
        $file_path = str_replace('\\','/',base_path()).'/public'.Storage::url(config('fileuploader.path').'/').$request->filename;
        if (file_exists($file_path)) {
            unlink($file_path);
            return $request->filename;
        }
	}
}
