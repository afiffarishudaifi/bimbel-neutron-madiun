<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replie extends Model
{
    use HasFactory;
    protected $guarded = [];

	public function posting(){
		return $this->belongsTo(Post::class,'post_id');
	}

    // public function siswa(){
	// 	return $this->belongsTo(Siswa::class,'siswa_id');
	// }

    public function siswa(){
        return Post::select('*')->leftJoin('siswas', function($join) {
            $join->on('siswas.id', '=', 'posts.siswa_id');
          })->where('posts.siswa_id',$this->siswa_id)->get();
		// return $this->belongsTo(Siswa::class,'siswa_id');
	}

    public function pengajar(){
        return Post::select('*')->leftJoin('pengajars', function($join) {
            $join->on('pengajars.id', '=', 'posts.pengajar_id');
          })->where('posts.pengajar_id',$this->pengajar_id)->get();
		// return $this->belongsTo(Siswa::class,'siswa_id');
	}

}
