<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index','show']]);
         $this->middleware('permission:post-create', ['only' => ['create','store']]);
         $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Semua Record Post";
        $pagination  = 10;
        $posts = Post::when($request->keyword, function ($query) use ($request) {
                // $query->where('page', 'like', "%{$request->keyword}%");
                $query;
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($posts->currentPage() - 1) * $posts->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $posts->count()) . " Data dari ". $posts->total(). " Data";
        return view('alza_admin.alza_modul.post.index', compact('posts', 'valuepage', 'labelcount','title'));
    }
    public function create()
    {
        $title = "Tambah Record Post";

        return view('alza_admin.alza_modul.post.create',compact('title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['post' => 'required','attachment' => 'mimes:png,jpg,jpeg,xls,xlsx,doc,docx,pdf,ppt,pptx|max:2048',]);
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
        $input['post'] = htmlentities(htmlspecialchars($request->post));
        Post::create($input);
        return redirect()->back()->with('success','Data berhasi diproses');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit($id)
    {
        $title = "Ubah Record Post";
        $post = Post::find($id);

        return view('alza_admin.alza_modul.post.edit',compact('title','post'));
    }

    public function update(Request $request, $id)
    {
        		$validator = Validator::make($request->all(), ['post' => 'required',]);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator)->withInput($request->all);
		}

        $post = Post::find($id);
        $post->update($request->all());
        return redirect()->route(config('pathadmin.admin_prefix').'posts.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'posts.index')->with('success','Data berhasi diproses');
    }
}
