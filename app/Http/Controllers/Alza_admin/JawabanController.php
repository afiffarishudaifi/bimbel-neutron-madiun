<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Groupsoal;
use App\Models\Siswa;


class JawabanController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:jawaban-list|jawaban-create|jawaban-edit|jawaban-delete', ['only' => ['index','show']]);
         $this->middleware('permission:jawaban-create', ['only' => ['create','store']]);
         $this->middleware('permission:jawaban-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:jawaban-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Jawaban";
        $pagination  = 20;
        $jawabans = Jawaban::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('jawab', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($jawabans->currentPage() - 1) * $jawabans->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $jawabans->count()) . " Data dari ". $jawabans->total(). " Data";
        return view('alza_admin.alza_modul.jawaban.index', compact('jawabans', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Jawaban";
		$groupsoal = Groupsoal::all();
		$siswa = Siswa::all();

        return view('alza_admin.alza_modul.jawaban.create',compact('title','groupsoal','siswa'));
    }

    public function store(Request $request)
    {
        		$validator = Validator::make($request->all(), ['jawab' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        Jawaban::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'jawabans.index')->with('success','Data berhasi diproses');
    }

    public function show(Jawaban $jawaban)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Jawaban";
        $jawaban = Jawaban::find($id);
		$groupsoal = Groupsoal::all();
		$siswa = Siswa::all();

        return view('alza_admin.alza_modul.jawaban.edit',compact('title','jawaban','groupsoal','siswa'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['jawab' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $jawaban = Jawaban::find($id);
        $jawaban->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'jawabans.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Jawaban $jawaban)
    {
        $jawaban->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'jawabans.index')->with('success','Data berhasi diproses');
    }
}
