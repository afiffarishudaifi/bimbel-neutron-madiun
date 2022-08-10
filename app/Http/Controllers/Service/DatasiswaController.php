<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DatasiswaController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->search;

        if($search == ''){
            $employees = Siswa::select("id","nama")->limit(5)->get();
        }else{
            $employees = Siswa::select("id","nama")->where('nama','LIKE',"%$search%")->limit(5)->get();
        }
        $response = array();
        foreach($employees as $employee){
            $response[] = array(
                "id"=>$employee->id,
                "text"=>$employee->nama
            );
        }

        return response()->json($response);
    }
}
