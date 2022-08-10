<?php

namespace App\Http\Controllers\Alza_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller

{

    public function index(Request $request)

    {

        $title = "Data User";
        $pagination  = 10;
        $users = User::when($request->keyword, function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->keyword}%");
            })->orderBy('id', 'ASC')->paginate($pagination);
        $valuepage = (($users->currentPage() - 1) * $users->perPage());
        $labelcount = "Menampilkan ". ($valuepage + 1) ." sampai ". ($valuepage + $users->count()) . " Data dari ". $users->total(). " Data";
        return view('alza_admin.alza_modul.users.index', compact('users', 'valuepage', 'labelcount','title'));

    }

    public function create()
    {
        $title = "Tambah Data User";
        $roles = Role::pluck('name','name')->all();

        return view('alza_admin.alza_modul.users.create',compact('roles','title'));

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route(config('pathadmin.admin_prefix').'users.index')
                        ->with('success','User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('alza_admin.alza_modul.users.show',compact('user'));
    }

    public function edit($id)
    {
        $title = "Ubah Data User";
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('alza_admin.alza_modul.users.edit',compact('user','roles','userRole','title'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route(config('pathadmin.admin_prefix').'users.index')
                        ->with('success','User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route(config('pathadmin.admin_prefix').'users.index')
                ->with('success','User deleted successfully');
    }
}
