<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Materitext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Mapel;
use App\Models\Entitas;
use App\Models\Matericategory;

class MateritextController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:materitext-list|materitext-create|materitext-edit|materitext-delete', ['only' => ['index','show']]);
         $this->middleware('permission:materitext-create', ['only' => ['create','store']]);
         $this->middleware('permission:materitext-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:materitext-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Materi text";
        $pagination  = 10;
        $materitexts = Materitext::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('no_urut', 'like', "%{$request->keyword}%")->where('nama_materitext', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($materitexts->currentPage() - 1) * $materitexts->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $materitexts->count()) . " Data dari ". $materitexts->total(). " Data";
        return view('alza_admin.alza_modul.materitext.index', compact('materitexts', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Materi text";
		$mapel = Mapel::all();
		$entitas = Entitas::all();
        $matericategory = Matericategory::all();
        return view('alza_admin.alza_modul.materitext.create',compact('title','mapel','entitas','matericategory'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['text' => 'required','no_urut' => 'required','nama_materitext' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}
        $input = $request->all();
        $input['text'] = htmlspecialchars(htmlentities($request->text));
        Materitext::create($input);
        return redirect()->route(config('pathadmin.admin_prefix').'materitexts.index')->with('success','Data berhasi diproses');
    }

    public function show(Materitext $materitext)
    {

    }

    public function edit($id)
    {
        $title = "Ubah Record Materi text";
        $materitext = Materitext::find($id);
		$mapel = Mapel::all();
		$entitas = Entitas::all();
        $matericategory = Matericategory::all();
        return view('alza_admin.alza_modul.materitext.edit',compact('title','materitext','mapel','entitas','matericategory'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['text' => 'required','no_urut' => 'required','nama_materitext' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $materitext = Materitext::find($id);
        $input = $request->all();
        $input['text'] = htmlspecialchars(htmlentities($request->text));
        $materitext->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'materitexts.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Materitext $materitext)
    {
        $materitext->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'materitexts.index')->with('success','Data berhasi diproses');
    }
}
