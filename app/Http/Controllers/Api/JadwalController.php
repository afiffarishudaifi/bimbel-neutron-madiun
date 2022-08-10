<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JadwalResource;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $kelas = Jadwal::where('kelas_id','=',$request->kelas_id)->orderBy('id', 'ASC')->get();
        return response()->json(JadwalResource::collection($kelas));
    }
}
