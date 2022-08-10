<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Matericategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kelas;
use App\Models\Mapel;

class MatericategoryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:matericategory-list|matericategory-create|matericategory-edit|matericategory-delete', ['only' => ['index','show']]);
         $this->middleware('permission:matericategory-create', ['only' => ['create','store']]);
         $this->middleware('permission:matericategory-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:matericategory-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Data Materi Kategori";
        $pagination  = 10;
        $matericategorys = Matericategory::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('matericategory_name', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($matericategorys->currentPage() - 1) * $matericategorys->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $matericategorys->count()) . " Data dari ". $matericategorys->total(). " Data";
        return view('alza_admin.alza_modul.matericategory.index', compact('matericategorys', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Data Materi Kategori";
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        return view('alza_admin.alza_modul.matericategory.create',compact('title','kelas','mapel'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['matericategory_name' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        Matericategory::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'matericategorys.index')->with('success','Data berhasi diproses');
    }

    public function show(Matericategory $matericategory)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Data Materi Kategori";
        $matericategory = Matericategory::find($id);
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        return view('alza_admin.alza_modul.matericategory.edit',compact('title','matericategory','kelas','mapel'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['matericategory_name' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $matericategory = Matericategory::find($id);
        $matericategory->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'matericategorys.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Matericategory $matericategory)
    {
        $matericategory->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'matericategorys.index')->with('success','Data berhasil diproses');
    }
}
