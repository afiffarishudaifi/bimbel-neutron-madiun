<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SemesterController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:semester-list|semester-create|semester-edit|semester-delete', ['only' => ['index','show']]);
         $this->middleware('permission:semester-create', ['only' => ['create','store']]);
         $this->middleware('permission:semester-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:semester-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Data Semester";
        $pagination  = 10;
        $semesters = Semester::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('nama_semester', 'like', "%{$request->keyword}%")->where('tahun', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($semesters->currentPage() - 1) * $semesters->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $semesters->count()) . " Data dari ". $semesters->total(). " Data";
        return view('alza_admin.alza_modul.semester.index', compact('semesters', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Data Semester";

        return view('alza_admin.alza_modul.semester.create',compact('title'));
    }

    public function store(Request $request)
    {
        		$validator = Validator::make($request->all(), ['nama_semester' => 'required','tahun' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        Semester::create($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'semesters.index')->with('success','Data berhasi diproses');
    }

    public function show(Semester $semester)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Data Semester";
        $semester = Semester::find($id);

        return view('alza_admin.alza_modul.semester.edit',compact('title','semester'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['nama_semester' => 'required','tahun' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $semester = Semester::find($id);
        $semester->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'semesters.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Semester $semester)
    {
        $semester->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'semesters.index')->with('success','Data berhasil diproses');
    }
}
