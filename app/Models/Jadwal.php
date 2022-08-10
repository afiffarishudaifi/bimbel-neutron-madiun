<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwals';
    protected $fillable = ['kelas_id','mapel_id','pengajar_id','hari','dari_jam','sampai_jam'];

	public function kelas(){
		return $this->belongsTo(Kelas::class,'kelas_id');
	}
	public function mapel(){
		return $this->belongsTo(Mapel::class,'mapel_id');
	}
    public function pengajar(){
		return $this->belongsTo(Pengajar::class,'pengajar_id');
	}

}
