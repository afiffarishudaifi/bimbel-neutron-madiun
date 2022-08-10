<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Helpers\AlzaHelpers as Az;

class PermissionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','show']]);
         $this->middleware('permission:permission-create', ['only' => ['create','store']]);
         $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $title = "Permission";
        $pagination  = 10;
        $permissions = Permission::when($request->keyword, function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($permissions->currentPage() - 1) * $permissions->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $permissions->count()) . " Data dari ". $permissions->total(). " Data";
        return view('alza_admin.alza_modul.permission.index', compact('permissions', 'valuepage', 'labelcount','title'));
    }

    public function create()
    {
        $title = "Tambah Permission";
        return view('alza_admin.alza_modul.permission.create',compact('title'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name'=>'required',
        ];
        $messages = [
            'name.required'=>'kolom nama permission wajib diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        $input = $request->all();
        Permission::create($input);
        return redirect()->route(config('pathadmin.admin_prefix').'permissions.index')->with('success','Data berhasi diproses');
    }

    public function show(Permission $permission)
    {
        //
    }

    public function edit(Permission $permission)
    {
        $title = "Ubah Permission";
        return view('alza_admin.alza_modul.permission.edit',compact('title','permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $rules = [
            'name'=>'required',
        ];
        $messages = [
            'name.required'=>'kolom nama permission wajib diisi',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        $input = $request->except('files');
        $permission->update($input);
        return redirect()->route(config('pathadmin.admin_prefix').'permissions.index')->with('success','Data berhasi diproses');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'permissions.index')->with('success','Data berhasi diproses');
    }
}
