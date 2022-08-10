<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class SiswaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:siswa-list|siswa-create|siswa-edit|siswa-delete', ['only' => ['index','show']]);
         $this->middleware('permission:siswa-create', ['only' => ['create','store']]);
         $this->middleware('permission:siswa-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:siswa-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Data Siswa";
        $pagination  = 10;
        $siswas = Siswa::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('nis', 'like', "%{$request->keyword}%")->where('nama', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($siswas->currentPage() - 1) * $siswas->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $siswas->count()) . " Data dari ". $siswas->total(). " Data";
        return view('alza_admin.alza_modul.siswa.index', compact('siswas', 'valuepage', 'labelcount','title'));
    }

    public function create()
    {
        $title = "Tambah Data Siswa";

        return view('alza_admin.alza_modul.siswa.create',compact('title'));
    }

    public function store(Request $request)
    {

		$file = $request->file('foto');
		$this->validate($request,[
            'nis' => 'required|min:5|max:20',
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'password' => 'required|password'
        ]);
 
		$input = $request->all();
		if (file_exists($file)) {
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/upload',
				$file,
				time()."_".$nama_file,
			);
            $input['foto'] = basename($pathfile);
		}else{
            $input = Arr::except($input,array('foto'));
        }

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }
        Siswa::create($input);
        return redirect()->route(config('pathadmin.admin_prefix').'siswas.index')->with('success','Data berhasi diproses');
    }

    public function show(Siswa $siswa)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Data Siswa";
        $siswa = Siswa::find($id);

        return view('alza_admin.alza_modul.siswa.edit',compact('title','siswa'));
    }

    public function update(Request $request, $id)
    {

        $siswa = Siswa::find($id);
		$file = $request->file('foto');
		$input = $request->except('imagenow');
		if (file_exists($file)) {
			Storage::disk('public')->delete('upload/'.$request->imagenow);
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/upload',
				$file,
				time()."_".$nama_file,
			);
			$input['foto'] = basename($pathfile);
		}else{
			$input = Arr::except($input,array('foto'));
		}
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }
        $siswa->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'siswas.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'siswas.index')->with('success','Data berhasil diproses');
    }
}
