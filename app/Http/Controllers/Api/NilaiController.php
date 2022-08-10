<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Http\Resources\NilaiResource;

class NilaiController extends Controller
{
    public function index($id)
    {
        $detil = Nilai::where('siswa_id',$id)->orderBy('id','DESC')->get();
        return response()->json(NilaiResource::collection($detil));
    }
}
