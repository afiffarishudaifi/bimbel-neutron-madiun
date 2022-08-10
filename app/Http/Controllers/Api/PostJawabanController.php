<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Nilai;
use App\Models\Soal;
use Illuminate\Http\Request;

class PostJawabanController extends Controller
{
    public function index(Request $request)
    {
        $jwb = json_decode($request->jawaban);
        $ls = [];
        $ls2 = [];
        $kunci = Soal::select('kunci')->where('groupsoal_id',$request->gsoalid)->orderBy('id','ASC')->get();
        foreach($kunci as $k){
            $ls[] = $k->kunci;
        }
        for ($i=0; $i < count($jwb); $i++) {
            $ls2[] = $jwb[$i];
        }
        $kuncix = $ls;
        $jawabx = $ls2;
        $totalsoal = $kunci->count();
        $benar = array_intersect($jawabx,$kuncix);
        $n = (count($benar)/$totalsoal)*100;
        Jawaban::create(['groupsoal_id'=>$request->gsoalid,'siswa_id'=>$request->siswaid,'jawab'=> serialize($ls2)]);
        Nilai::create(['groupsoal_id'=>$request->gsoalid,'siswa_id'=>$request->siswaid,'nilai'=>$n]);
        return $n;
    }
}
