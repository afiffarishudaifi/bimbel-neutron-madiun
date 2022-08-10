<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Replie;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ForumController extends Controller
{
    public function simpan_post(Request $request)
    {
        $file = $request->file('attachment');
        $input = $request->all();
        if (file_exists($file)) {
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/upload',
				$file,
				time()."_".$nama_file
			);
            $input['attachment'] = basename($pathfile);
		}else{
            $input = Arr::except($input,array('attachment'));
        }
        
        $act = Post::create($input);
        if ($act) {
            return 1;
        }else{
            return 0;
        }
    }

    public function simpan_replies(Request $request)
    {
        $act = Replie::create($request->all());
        if ($act) {
            return 1;
        }else{
            return 0;
        }
    }

    public function hapus_post(Request $request,$id)
    {
        $post = Post::find($id);
        $d = $post->delete();
        if ($d) {
            return 1;
        }else{
            return 0;
        }
    }

    public function hapus_replies(Request $request,$id)
    {
        $post = Replie::find($id);
        $d = $post->delete();
        if ($d) {
            return 1;
        }else{
            return 0;
        }
    }
}
