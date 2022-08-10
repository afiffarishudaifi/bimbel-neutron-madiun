<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MateritextResource;
use App\Models\Materitext;
use Illuminate\Http\Request;

class MateritextController extends Controller
{
    public function index(Request $request)
    {
        $materi = Materitext::with('entitas')->whereHas('entitas',function($q) use ($request){
            $q->where('kelas_id',$request->kelas_id);
            $q->groupBy('kelas_id');
        })->where('matericategory_id',$request->matericategoryid)->orderBy('no_urut','ASC')->get();
        return response()->json(['data'=>MateritextResource::collection($materi),'length'=>$materi->count()]);
        // return response()->json(MateritextResource::collection($materi));
    }
}
