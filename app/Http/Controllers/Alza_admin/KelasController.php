<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class KelasController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:kelas-list|kelas-create|kelas-edit|kelas-delete', ['only' => ['index','show']]);
         $this->middleware('permission:kelas-create', ['only' => ['create','store']]);
         $this->middleware('permission:kelas-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:kelas-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Data Kelas";
        $pagination  = 10;
        $kelass = Kelas::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('nama_kelas', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($kelass->currentPage() - 1) * $kelass->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $kelass->count()) . " Data dari ". $kelass->total(). " Data";
        return view('alza_admin.alza_modul.kelas.index', compact('kelass', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Data Kelas";

        return view('alza_admin.alza_modul.kelas.create',compact('title'));
    }

    public function store(Request $request)
    {
        
        Kelas::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'kelass.index')->with('success','Data berhasi diproses');
    }

    public function show(Kelas $kelas)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Data Kelas";
        $kelas = Kelas::find($id);

        return view('alza_admin.alza_modul.kelas.edit',compact('title','kelas'));
    }

    public function update(Request $request, $id)
    {
        
        $kelas = Kelas::find($id);
        $kelas->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'kelass.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'kelass.index')->with('success','Data berhasil diproses');
    }
}
