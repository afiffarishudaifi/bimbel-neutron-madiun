<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupsoal extends Model
{
    use HasFactory;
    protected $guarded = [];

	public function entitas(){
		return $this->belongsTo(Entitas::class,'entitas_id');
	}
	public function mapel(){
		return $this->belongsTo(Mapel::class,'mapel_id');
	}
	public function pengajar(){
		return $this->belongsTo(Pengajar::class,'pengajar_id');
	}

}
