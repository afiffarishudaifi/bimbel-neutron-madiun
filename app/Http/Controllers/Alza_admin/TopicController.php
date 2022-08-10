<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pengajar;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class TopicController extends Controller
{
    function __construct()
    {
        // if(Session::get('role')!='Pengajar'){
        //     return abort(403);
        // }
         $this->middleware('permission:topic-list|topic-create|topic-edit|topic-delete', ['only' => ['index','show']]);
         $this->middleware('permission:topic-create', ['only' => ['create','store']]);
         $this->middleware('permission:topic-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:topic-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Topic";
        $pagination  = 10;
        $topics = Topic::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query->where('title', 'like', "%{$request->keyword}%");
            })->where('pengajar_id','=',Session::get('id'))->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($topics->currentPage() - 1) * $topics->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $topics->count()) . " Data dari ". $topics->total(). " Data";
        return view('alza_admin.alza_modul.topic.index', compact('topics', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Topic";
		$kelas = Kelas::all();
		$mapel = Mapel::all();
		$pengajar = Pengajar::all();

        return view('alza_admin.alza_modul.topic.create',compact('title','kelas','mapel','pengajar'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['title' => 'required','desc' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}
        $input = $request->all();
        $input['desc'] = htmlentities(htmlspecialchars($request->desc));
        Topic::create($input);
        return redirect()->route(config('pathadmin.admin_prefix').'topics.index')->with('success','Data berhasi diproses');
    }

    public function show(Request $request,$id)
    {
        $title = "Show";
        $pagination  = 10;
        $posts= Post::where('topic_id',$id)->orderBy('id', 'DESC')->paginate($pagination);
        $valuepage = (($posts->currentPage() - 1) * $posts->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $posts->count()) . " Data dari ". $posts->total(). " Data";
        return view('alza_admin.alza_modul.topic.show',compact('posts', 'valuepage', 'labelcount','title'));
    }

    public function edit($id)
    {
        $title = "Ubah Record Topic";
        $topic = Topic::find($id);
		$kelas = Kelas::all();
		$mapel = Mapel::all();
		$pengajar = Pengajar::all();

        return view('alza_admin.alza_modul.topic.edit',compact('title','topic','kelas','mapel','pengajar'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['title' => 'required','desc' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $topic = Topic::find($id);
        $input = $request->all();
        $input['desc'] = htmlentities(htmlspecialchars($request->desc));
        $topic->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'topics.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'topics.index')->with('success','Data berhasi diproses');
    }
}
