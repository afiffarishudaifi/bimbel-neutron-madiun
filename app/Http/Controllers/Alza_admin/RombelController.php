<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Rombel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Siswa;
use App\Models\Entitas;


class RombelController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:rombel-list|rombel-create|rombel-edit|rombel-delete', ['only' => ['index','show']]);
         $this->middleware('permission:rombel-create', ['only' => ['create','store']]);
         $this->middleware('permission:rombel-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:rombel-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Data Rombel";
        $pagination  = 10;
        $rombels = Rombel::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query;
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($rombels->currentPage() - 1) * $rombels->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $rombels->count()) . " Data dari ". $rombels->total(). " Data";
        return view('alza_admin.alza_modul.rombel.index', compact('rombels', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Data Rombel";
		$siswa = Siswa::all();
		$entitas = Entitas::all();

        return view('alza_admin.alza_modul.rombel.create',compact('title','siswa','entitas'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        Rombel::create($request->all());
        return redirect()->back()->with('success','Data berhasi diproses');
        // return redirect()->route(config('pathadmin.admin_prefix').'rombels.index')->with('success','Data berhasi diproses');
    }

    public function show(Rombel $rombel)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Data Rombel";
        $rombel = Rombel::find($id);
		$siswa = Siswa::all();
		$entitas = Entitas::all();

        return view('alza_admin.alza_modul.rombel.edit',compact('title','rombel','siswa','entitas'));
    }

    public function update(Request $request, $id)
    {

        $rombel = Rombel::find($id);
        $rombel->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'rombels.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Rombel $rombel)
    {
        $rombel->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'rombels.index')->with('success','Data berhasil diproses');
    }
}
