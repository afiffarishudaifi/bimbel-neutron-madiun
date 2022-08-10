<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalForumController extends Controller
{
    public function index(Request $request)
    {
        $result = [];
        $kelas = Jadwal::where('kelas_id','=',$request->kelas_id)->orderBy('id', 'ASC')->get();
        foreach($kelas  as $kl){
            $topic = Topic::where('kelas_id',$kl->kelas_id)->where('mapel_id',$kl->mapel_id)->get();
            if($topic->count()>0){
                $result[] = array(
                    'id'=>$kl->id,
                    'mapel'=>$kl->mapel->nama_mapel,
                    'mapelid'=>$kl->mapel->id,
                    'topikcount'=>$topic->count(),
                    'hari'=>$kl->hari,
                    'dari'=>$kl->dari_jam,
                    'sampai'=>$kl->sampai_jam
                );
            }
        }
        return response()->json($result);
    }
}
