<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use Illuminate\Http\Request;
use App\Models\Identitas;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        $iden = Identitas::select('about')->where('id',1)->first();
        return response()->json([AboutResource::make($iden)]);
    }
}
