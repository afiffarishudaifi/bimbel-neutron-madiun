<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Matervideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Mapel;
use App\Models\Entitas;
use App\Models\Matericategory;

class MatervideoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:matervideo-list|matervideo-create|matervideo-edit|matervideo-delete', ['only' => ['index','show']]);
         $this->middleware('permission:matervideo-create', ['only' => ['create','store']]);
         $this->middleware('permission:matervideo-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:matervideo-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Data Materi video";
        $pagination  = 10;
        $matervideos = Matervideo::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query;
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($matervideos->currentPage() - 1) * $matervideos->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $matervideos->count()) . " Data dari ". $matervideos->total(). " Data";
        return view('alza_admin.alza_modul.matervideo.index', compact('matervideos', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Data Materi video";
		$mapel = Mapel::all();
		$entitas = Entitas::all();
        $matericategory = Matericategory::all();
        return view('alza_admin.alza_modul.matervideo.create',compact('title','mapel','entitas','matericategory'));
    }

    public function store(Request $request)
    {
        		$validator = Validator::make($request->all(), ['link_embed' => 'required','no_urut' => 'required','nama_materivideo' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        Matervideo::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'matervideos.index')->with('success','Data berhasi diproses');
    }

    public function show(Matervideo $matervideo)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Data Materi video";
        $matervideo = Matervideo::find($id);
		$mapel = Mapel::all();
		$entitas = Entitas::all();
        $matericategory = Matericategory::all();
        return view('alza_admin.alza_modul.matervideo.edit',compact('title','matervideo','mapel','entitas','matericategory'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['link_embed' => 'required','no_urut' => 'required','nama_materivideo' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $matervideo = Matervideo::find($id);
        $matervideo->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'matervideos.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Matervideo $matervideo)
    {
        $matervideo->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'matervideos.index')->with('success','Data berhasil diproses');
    }
}
