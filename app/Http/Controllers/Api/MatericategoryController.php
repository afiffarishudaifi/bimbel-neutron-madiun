<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatericategoryResource;
use App\Models\Matericategory;
use Illuminate\Http\Request;

class MatericategoryController extends Controller
{
    public function index(Request $request)
    {
        $kelas = Matericategory::where('kelas_id','=',$request->kelas_id)->where('mapel_id','=',$request->mapel_id)->orderBy('id', 'ASC')->get();
        return response()->json(MatericategoryResource::collection($kelas));
    }
}
