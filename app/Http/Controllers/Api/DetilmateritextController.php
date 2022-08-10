<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DetilmateritextResource;
use App\Models\Materitext;
use Illuminate\Http\Request;

class DetilmateritextController extends Controller
{
    public function index($id)
    {
        $detil = Materitext::where('id',$id)->get();
        return response()->json(DetilmateritextResource::collection($detil),200);
    }
}
