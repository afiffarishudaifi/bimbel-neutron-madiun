<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Groupsoal;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class SoalController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:soal-list|soal-create|soal-edit|soal-delete', ['only' => ['index','show']]);
         $this->middleware('permission:soal-create', ['only' => ['create','store']]);
         $this->middleware('permission:soal-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:soal-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Data Soal";
        $pagination  = 10;
        $soals = Soal::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query;
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($soals->currentPage() - 1) * $soals->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $soals->count()) . " Data dari ". $soals->total(). " Data";
        return view('alza_admin.alza_modul.soal.index', compact('soals', 'valuepage', 'labelcount','title'));
    }

    public function create()
    {
        $title = "Tambah Data Soal";
        $groupsoal = Groupsoal::all();
        return view('alza_admin.alza_modul.soal.create',compact('title','groupsoal'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['uraian' => 'required','gambar' => 'mimes:png,jpg,jpeg|max:2048','opsia' => 'required','opsib' => 'required','opsic' => 'required','opsid' => 'required','opsie' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

		$file = $request->file('gambar');
		$input = $request->all();
		if (file_exists($file)) {
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/upload',
				$file,
				time()."_".$nama_file,
			);
            $input['gambar'] = basename($pathfile);
		}else{
            $input = Arr::except($input,array('gambar'));
        }
        $input['uraian'] = htmlentities(htmlspecialchars($request->uraian));
        Soal::create($input);
        return redirect()->route(config('pathadmin.admin_prefix').'soals.index')->with('success','Data berhasi diproses');
    }

    public function show(Soal $soal)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Data Soal";
        $soal = Soal::find($id);
        $groupsoal = Groupsoal::all();
        return view('alza_admin.alza_modul.soal.edit',compact('title','soal','groupsoal'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['uraian' => 'required','gambar' => 'mimes:png,jpg,jpeg|max:2048','opsia' => 'required','opsib' => 'required','opsic' => 'required','opsid' => 'required','opsie' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $soal = Soal::find($id);
		$file = $request->file('gambar');
		$input = $request->except('imagenow');
		if (file_exists($file)) {
			Storage::disk('public')->delete('upload/'.$request->imagenow);
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/upload',
				$file,
				time()."_".$nama_file,
			);
			$input['gambar'] = basename($pathfile);
		}else{
			$input['gambar'] = $request->imagenow;
		}
        $input['uraian'] = htmlentities(htmlspecialchars($request->uraian));
        $soal->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'soals.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Soal $soal)
    {
        $soal->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'soals.index')->with('success','Data berhasil diproses');
    }
}
