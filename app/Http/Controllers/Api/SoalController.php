<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SoalResource;
use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index($id)
    {
        $pagination = 1;
        $soal = Soal::where('groupsoal_id',$id);
        $length = $soal->get();
        $soals = $soal->paginate($pagination);
        return response()->json(['data'=>SoalResource::collection($soals),'length'=>count($length)]);
    }
}
