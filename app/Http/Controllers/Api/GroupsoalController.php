<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatatanResource;
use App\Http\Resources\GroupsoalResource;
use App\Models\Groupsoal;
use App\Models\Jawaban;
use Illuminate\Http\Request;

class GroupsoalController extends Controller
{
    public function index(Request $request)
    {
        $notin = [];
        $check = Jawaban::select('groupsoal_id')->where('siswa_id',$request->siswa_id)->get();
        foreach($check as $ck){
            $notin[] = $ck->groupsoal_id;
        }
        $gs = Groupsoal::whereHas('entitas',function($q) use ($request){
            $q->where('kelas_id',$request->kelas_id);
        })->where('aktif','=','1')->whereNotIn('id', $notin)->get();
        return response()->json(GroupsoalResource::collection($gs));
    }

    public function catatan($id)
    {
        $catatan = Groupsoal::where('id',$id)->get();
        return response()->json(CatatanResource::collection($catatan));
    }
}
