<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AlzaHelpers;
use App\Http\Controllers\Controller;
use App\Models\Rombel;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthsiswaController extends Controller
{
    public function signin(Request $request)
    {
        $input = $request->all();
        if (Auth::guard('siswa')->attempt(array('nis' => $input['nis'], 'password' => $input['password']))) {
            if (Auth::guard('siswa')->user()) {
                $userx = Auth::guard('siswa')->user();
                $rombel = Rombel::where('siswa_id',$userx->id)->get()->first();
                $data = array(
                    'value'=>1,
                    'nama'=>$userx->nama,
                    'alamat'=>$userx->alamat,
                    'email'=>$userx->email,
                    'gender'=>$userx->gender,
                    'id'=>$userx->id,
                    'nis'=>$userx->nis,
                    'foto'=>$userx->foto,
                    'entitasid'=>(int)$rombel->entitas_id,
                    'kelas'=>$rombel->count() > 0 ? $rombel->entitas->kelas->nama_kelas : '',
                    'kelasid'=>$rombel->count() > 0 ? $rombel->entitas->kelas->id : '',
                    'jenjang'=>$rombel->count() > 0 ? $rombel->entitas->jenjang->nama_jenjang : '',
                    'jenjangid'=>$rombel->count() > 0 ? $rombel->entitas->jenjang->id : '',
                );
                return response()->json([$data]);
            }
            return response()->json([array('error'=>'Belum ada data yang sesuai.','value'=>0)]);
        } else {
            return response()->json([array('error'=>'Belum ada data yang sesuai.','value'=>0)]);
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), ['nama' => 'required','nis' => 'required|min:6','password' => 'required']);
        if ($validator->fails()) {
            return response()->json([$validator->errors()], 400);
        }
		$input = $request->all();
        $input['nama'] = $request->nama;
        $input['nis'] = $request->nis;
        $input['password'] = Hash::make($request->password);
        Siswa::create($input);
        return response()->json([array('success'=>'Anda berhasil daftar','code'=>200,'value'=>1,'phonebimbel'=>AlzaHelpers::kontak())]);
    }
}
