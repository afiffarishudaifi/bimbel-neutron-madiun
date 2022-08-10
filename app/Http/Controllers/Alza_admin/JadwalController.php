<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pengajar;

class JadwalController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:jadwal-list|jadwal-create|jadwal-edit|jadwal-delete', ['only' => ['index','show']]);
         $this->middleware('permission:jadwal-create', ['only' => ['create','store']]);
         $this->middleware('permission:jadwal-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:jadwal-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Jadwal";
        $pagination  = 10;
        $jadwals = Jadwal::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query;
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($jadwals->currentPage() - 1) * $jadwals->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $jadwals->count()) . " Data dari ". $jadwals->total(). " Data";
        return view('alza_admin.alza_modul.jadwal.index', compact('jadwals', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Jadwal";
		$kelas = Kelas::all();
		$mapel = Mapel::all();
        $pengajar = Pengajar::all();

        return view('alza_admin.alza_modul.jadwal.create',compact('title','kelas','mapel','pengajar'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['hari' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        Jadwal::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'jadwals.index')->with('success','Data berhasi diproses');
    }

    public function show(Jadwal $jadwal)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Jadwal";
        $jadwal = Jadwal::find($id);
		$kelas = Kelas::all();
		$mapel = Mapel::all();
		$pengajar = Pengajar::all();

        return view('alza_admin.alza_modul.jadwal.edit',compact('title','jadwal','kelas','mapel','pengajar'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['hari' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $jadwal = Jadwal::find($id);
        //print_r($jadwal);
        //print_r($request->all());die;
        $jadwal->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'jadwals.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'jadwals.index')->with('success','Data berhasi diproses');
    }
}
