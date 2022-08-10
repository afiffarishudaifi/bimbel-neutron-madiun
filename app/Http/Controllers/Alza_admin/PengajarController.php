<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\Pengajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class PengajarController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:pengajar-list|pengajar-create|pengajar-edit|pengajar-delete', ['only' => ['index','show']]);
         $this->middleware('permission:pengajar-create', ['only' => ['create','store']]);
         $this->middleware('permission:pengajar-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pengajar-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Data Pengajar";
        $pagination  = 10;
        $pengajars = Pengajar::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('noinduk', 'like', "%{$request->keyword}%")->where('nama_pengajar', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($pengajars->currentPage() - 1) * $pengajars->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $pengajars->count()) . " Data dari ". $pengajars->total(). " Data";
        return view('alza_admin.alza_modul.pengajar.index', compact('pengajars', 'valuepage', 'labelcount','title'));
    }

    public function create()
    {
        $title = "Tambah Data Pengajar";
        $roles = Role::pluck('name','name')->all();
        return view('alza_admin.alza_modul.pengajar.create',compact('title','roles'));
    }

    public function store(Request $request)
    {
        		$validator = Validator::make($request->all(), ['noinduk' => 'required','nama_pengajar' => 'required']);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

		$file = $request->file('foto');
		$input = $request->all();
        $input['password'] = Hash::make($input['password']);

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


        $pengajar = Pengajar::create($input);
        $pengajar->assignRole('Pengajar');
        return redirect()->route(config('pathadmin.admin_prefix').'pengajars.index')->with('success','Data berhasi diproses');
    }

    public function show(Pengajar $pengajar)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Data Pengajar";
        $pengajar = Pengajar::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $pengajar->roles->pluck('name','name')->all();
        return view('alza_admin.alza_modul.pengajar.edit',compact('title','pengajar','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['noinduk' => 'required','nama_pengajar' => 'required']);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $pengajar = Pengajar::find($id);

		$file = $request->file('foto');
		$input = $request->except('imagenow');
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

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
			$input['foto'] = $request->imagenow;
		}

        $pengajar->update($input);
        // DB::table('model_has_roles')->where('model_id',$id)->delete();
        $pengajar->assignRole('Pengajar');
        return redirect()->route(config('pathadmin.admin_prefix').'pengajars.index')->with('success','Data berhasil diproses');
    }

    public function destroy(Pengajar $pengajar)
    {
        $pengajar->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'pengajars.index')->with('success','Data berhasi diproses');
    }
}
