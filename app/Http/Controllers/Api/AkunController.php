<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class AkunController extends Controller
{
    public function update(Request $request,$id)
    {
        try {
            $siswa = Siswa::find($id);
            $input = $request->all();
            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }else{
                $input = Arr::except($input,array('password'));
            }
            $p = $siswa->update($input);
            if ($p) {
                $data = array(

                    'value'=>1,
                    'nama'=>$siswa->nama,
                    'id'=>$siswa->id,
                    'email'=>$siswa->email,
                    'alamat'=>$siswa->alamat,
                    'gender'=>$siswa->gender,);
                return response()->json([$data]);
            }else{
                return 2;
            }
        } catch (\Throwable $th) {
            return 3;
        }

    }
}
