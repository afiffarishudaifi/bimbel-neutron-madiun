<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Groupsoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Entitas;
use App\Models\Mapel;
use App\Models\Pengajar;

class GroupsoalController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:groupsoal-list|groupsoal-create|groupsoal-edit|groupsoal-delete', ['only' => ['index','show']]);
         $this->middleware('permission:groupsoal-create', ['only' => ['create','store']]);
         $this->middleware('permission:groupsoal-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:groupsoal-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Data Groupsoal";
        $pagination  = 10;
        $groupsoals = Groupsoal::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('start_date', 'like', "%{$request->keyword}%")->where('expired_date', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($groupsoals->currentPage() - 1) * $groupsoals->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $groupsoals->count()) . " Data dari ". $groupsoals->total(). " Data";
        return view('alza_admin.alza_modul.groupsoal.index', compact('groupsoals', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Data Groupsoal";
		$entitas = Entitas::all();
		$mapel = Mapel::all();
		$pengajar = Pengajar::all();

        return view('alza_admin.alza_modul.groupsoal.create',compact('title','entitas','mapel','pengajar'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['catatan'] = htmlentities(htmlspecialchars($request->catatan));
        Groupsoal::create($input);
        return redirect()->route(config('pathadmin.admin_prefix').'groupsoals.index')->with('success','Data berhasi diproses');
    }

    public function show(Groupsoal $groupsoal)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Data Groupsoal";
        $groupsoal = Groupsoal::find($id);
		$entitas = Entitas::all();
		$mapel = Mapel::all();
		$pengajar = Pengajar::all();

        return view('alza_admin.alza_modul.groupsoal.edit',compact('title','groupsoal','entitas','mapel','pengajar'));
    }

    public function update(Request $request, $id)
    {

        $groupsoal = Groupsoal::find($id);
        $input = $request->all();

        $input['catatan'] = htmlentities(htmlspecialchars($request->catatan));
        $groupsoal->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'groupsoals.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Groupsoal $groupsoal)
    {
        $groupsoal->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'groupsoals.index')->with('success','Data berhasil diproses');
    }
}
