<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IdentitasController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:iden-list|iden-create|iden-edit|iden-delete', ['only' => ['index','show']]);
         $this->middleware('permission:iden-edit', ['only' => ['edit','update']]);
    }

    public function index(){
        $title = "Konfigurasi";
        $iden = Identitas::find(1);
        return view('alza_admin.alza_modul.identitas.index',compact('title','iden'));
    }

    public function update(Request $request, Identitas $iden){
        $file = $request->file('logo_web');
        if (file_exists($file)) {
            $input = $request->all();
            $nama_file = $file->getClientOriginalName();
		    $pathfile = Storage::putFileAs(
                'public/logo',
                $request->file('logo_web'),
                time()."_".$nama_file,
            );
            $input['logo_web'] = basename($pathfile);
            $input['about'] = htmlentities(htmlspecialchars($request->about));
            $iden->update($input);
            return redirect()->route(config('pathadmin.admin_prefix').'iden.index')->with('success','Data berhasi diproses');
        }else{
            $input = $request->all();
            $input['about'] = htmlentities(htmlspecialchars($request->about));
            $iden->update($input);
            return redirect()->route(config('pathadmin.admin_prefix').'iden.index')->with('success','Data berhasi diproses');
        }
    }

    // public function updatefoto(Request $request, Identitas $iden){
    //     $file = $request->file('foto_kades');
    //     if (file_exists($file)) {
    //         $input = $request->all();
    //         $nama_file = time()."_".$file->getClientOriginalName();
	// 	    $tujuan_upload = 'foto';
    //         $file->move($tujuan_upload,$nama_file);
    //         $input['foto_kades'] = $nama_file;
    //         $iden->update($input);
    //         return redirect()->route(config('pathadmin.admin_prefix').'iden.index')->with('success','Data berhasi diproses');
    //     }else{
    //         $input = $request->all();
    //         $iden->update($input);
    //         return redirect()->route(config('pathadmin.admin_prefix').'iden.index')->with('success','Data berhasi diproses');
    //     }
    // }
}
