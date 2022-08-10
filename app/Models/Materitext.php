<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materitext extends Model
{
    use HasFactory;
    protected $guarded= [];

	public function mapel(){
		return $this->belongsTo(Mapel::class,'mapel_id');
	}
	public function entitas(){
		return $this->belongsTo(Entitas::class,'entitas_id');
	}

}
