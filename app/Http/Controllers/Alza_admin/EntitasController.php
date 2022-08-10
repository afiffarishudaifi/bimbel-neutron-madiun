<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Entitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\Jenjang;


class EntitasController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:entitas-list|entitas-create|entitas-edit|entitas-delete', ['only' => ['index','show']]);
         $this->middleware('permission:entitas-create', ['only' => ['create','store']]);
         $this->middleware('permission:entitas-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:entitas-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Data Entitas";
        $pagination  = 10;
        $entitass = Entitas::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query;
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($entitass->currentPage() - 1) * $entitass->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $entitass->count()) . " Data dari ". $entitass->total(). " Data";
        return view('alza_admin.alza_modul.entitas.index', compact('entitass', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Data Entitas";
		$jenjang = Jenjang::all();
		$kelas = Kelas::all();
		$semester = Semester::all();

        return view('alza_admin.alza_modul.entitas.create',compact('title','jenjang','kelas','semester'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        Entitas::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'entitass.index')->with('success','Data berhasi diproses');
    }

    public function show(Entitas $entitas)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Data Entitas";
		$jenjang = Jenjang::all();
		$kelas = Kelas::all();
		$semester = Semester::all();
        $entitas = Entitas::find($id);

        return view('alza_admin.alza_modul.entitas.edit',compact('title','entitas','jenjang','kelas','semester'));
    }

    public function update(Request $request, $id)
    {

        $entitas = Entitas::find($id);
        $entitas->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'entitass.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Entitas $entitas)
    {
        $entitas->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'entitass.index')->with('success','Data berhasil diproses');
    }
}
