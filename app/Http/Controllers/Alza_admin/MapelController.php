<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MapelController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:mapel-list|mapel-create|mapel-edit|mapel-delete', ['only' => ['index','show']]);
         $this->middleware('permission:mapel-create', ['only' => ['create','store']]);
         $this->middleware('permission:mapel-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:mapel-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Data Mapel";
        $pagination  = 10;
        $mapels = Mapel::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('nama_mapel', 'like', "%{$request->keyword}%")->where('kode', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($mapels->currentPage() - 1) * $mapels->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $mapels->count()) . " Data dari ". $mapels->total(). " Data";
        return view('alza_admin.alza_modul.mapel.index', compact('mapels', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Data Mapel";

        return view('alza_admin.alza_modul.mapel.create',compact('title'));
    }

    public function store(Request $request)
    {
        		$validator = Validator::make($request->all(), ['nama_mapel' => 'required','kode' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        Mapel::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'mapels.index')->with('success','Data berhasi diproses');
    }

    public function show(Mapel $mapel)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Data Mapel";
        $mapel = Mapel::find($id);

        return view('alza_admin.alza_modul.mapel.edit',compact('title','mapel'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['nama_mapel' => 'required','kode' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $mapel = Mapel::find($id);
        $mapel->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'mapels.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'mapels.index')->with('success','Data berhasil diproses');
    }
}
