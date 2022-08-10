<?php

namespace App\Http\Controllers\Alza_admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajar;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Dashboard';
        $pengajar = Pengajar::all();
        $siswa = Siswa::all();
        return view('alza_admin.alza_modul.alza_dashboard',compact('title','pengajar','siswa'));
    }
}
