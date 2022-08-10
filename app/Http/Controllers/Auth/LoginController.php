<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->redirectTo = '/'.config('pathadmin.admin_name').'/home';
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // $request->session->flush();
        $input = $request->all();

        $rules = [
            'email' => 'required',
            'password' => 'required|min:6',
            'level'=> 'required|in:pengajar,admin|not_in:-',
        ];

        $message = [
            'email.required'        => 'kolom email masih kosong!',
            'password.required'     => 'password masih kosong!',
            'password.min'          => 'password harus 6 charakter!',
            'level.required'        => 'level wajib dipilih',
            'level.in'              => 'level hanya admin, dan pengajar!',
            'level.not_in'          => 'pilih salah satu level'
        ];
        $this->validate($request, $rules,$message);
        if ($input['level']=='admin') {
            if (Auth::attempt(array('email' => $input['email'], 'password' => $input['password']))) {
                if (Auth::user()) {
                    $userx = Auth::user();
                    // dd($userx->roles);
                    // dd($userx->can('role-list'));
                    Session::put('nama',$userx->name);
                    Session::put('email',$userx->email);
                    Session::put('id',$userx->id);
                    Session::put('role',$userx->getRoleNames()[0]);
                    return redirect('/'.config('pathadmin.admin_name').'/home');
                }
                return redirect()->route('login')
                    ->with('error', 'Email Dan Password Salah.');
            } else {
                return redirect()->route('login')
                    ->with('error', 'Email Dan Password Salah.');
            }
        }elseif($input['level']=='pengajar'){
            // dd(Auth::guard('pengajar')->attempt(array('email' => $input['email'], 'password' => $input['password'])));
            if (Auth::guard('pengajar')->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
                if (Auth::guard('pengajar')->user()) {
                    // Auth::guard()->logout();
                    $userx = Auth::guard('pengajar')->user();
                    // dd($userx->can('role-list'));
                    Session::put('nama',$userx->nama_pengajar);
                    Session::put('email',$userx->email);
                    Session::put('id',$userx->id);
                    Session::put('foto',$userx->foto);
                    Session::put('role',$userx->getRoleNames()[0]);
                    return redirect('/'.config('pathadmin.admin_name').'/home');
                }
                return redirect()->route('login')
                    ->with('error', 'Email Dan Password Salah.');
            } else {
                return redirect()->route('login')
                ->with('error', 'Email Dan Password Salah.');
            }
        }else{
            return redirect()->route('login')
                ->with('error', 'level yang dipilih tidak sesuai!');
        }

    }
}
