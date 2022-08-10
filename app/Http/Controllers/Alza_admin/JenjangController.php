<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Jenjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class JenjangController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:jenjang-list|jenjang-create|jenjang-edit|jenjang-delete', ['only' => ['index','show']]);
         $this->middleware('permission:jenjang-create', ['only' => ['create','store']]);
         $this->middleware('permission:jenjang-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:jenjang-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Data Jenjang";
        $pagination  = 10;
        $jenjangs = Jenjang::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('nama_jenjang', 'like', "%{$request->keyword}%")->where('ket', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($jenjangs->currentPage() - 1) * $jenjangs->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $jenjangs->count()) . " Data dari ". $jenjangs->total(). " Data";
        return view('alza_admin.alza_modul.jenjang.index', compact('jenjangs', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Data Jenjang";

        return view('alza_admin.alza_modul.jenjang.create',compact('title'));
    }

    public function store(Request $request)
    {
        
        Jenjang::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'jenjangs.index')->with('success','Data berhasi diproses');
    }

    public function show(Jenjang $jenjang)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Data Jenjang";
        $jenjang = Jenjang::find($id);

        return view('alza_admin.alza_modul.jenjang.edit',compact('title','jenjang'));
    }

    public function update(Request $request, $id)
    {
        
        $jenjang = Jenjang::find($id);
        $jenjang->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'jenjangs.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Jenjang $jenjang)
    {
        $jenjang->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'jenjangs.index')->with('success','Data berhasil diproses');
    }
}
