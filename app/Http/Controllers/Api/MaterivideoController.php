<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MaterivideoResource;
use App\Models\Matervideo;
use Illuminate\Http\Request;

class MaterivideoController extends Controller
{

    public function index(Request $request)
    {
        $materi = Matervideo::with('entitas')->whereHas('entitas',function($q) use ($request){
            $q->where('kelas_id',$request->kelas_id);
            $q->groupBy('kelas_id');
        })->where('matericategory_id',$request->matericategoryid)->orderBy('no_urut','ASC')->get();
        return response()->json(MaterivideoResource::collection($materi));
    }

}
