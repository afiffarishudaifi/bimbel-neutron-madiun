<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Replie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;


class ReplieController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:replie-list|replie-create|replie-edit|replie-delete', ['only' => ['index','show']]);
         $this->middleware('permission:replie-create', ['only' => ['create','store']]);
         $this->middleware('permission:replie-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:replie-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Replies";
        $pagination  = 10;
        $replies = Replie::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query;
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($replies->currentPage() - 1) * $replies->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $replies->count()) . " Data dari ". $replies->total(). " Data";
        return view('alza_admin.alza_modul.replie.index', compact('replies', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Replies";

        return view('alza_admin.alza_modul.replie.create',compact('title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['reply' => 'required','attachment' => 'mimes:png,jpg,jpeg,xls,xlsx,doc,docx,pdf,ppt,pptx|max:2048',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}
        $file = $request->file('attachment');
		$input = $request->all();
        if (file_exists($file)) {
			$nama_file = $file->getClientOriginalName();
			$pathfile = Storage::putFileAs(
				'public/upload',
				$file,
				time()."_".$nama_file,
			);
            $input['attachment'] = basename($pathfile);
		}else{
            $input = Arr::except($input,array('attachment'));
        }
        $input['reply'] = htmlentities(htmlspecialchars($request->reply));
        Replie::create($input);
        return redirect()->back()->with('success','Data berhasi diproses');
    }

    public function show(Replie $replie)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Replies";
        $replie = Replie::find($id);

        return view('alza_admin.alza_modul.replie.edit',compact('title','replie'));
    }

    public function update(Request $request, $id)
    {

        $replie = Replie::find($id);
        $replie->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'replies.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Replie $replie)
    {
        $replie->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'replies.index')->with('success','Data berhasi diproses');
    }
}
