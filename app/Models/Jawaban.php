<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    protected $fillable = ['groupsoal_id','siswa_id','jawab'];

	public function groupsoal(){
		return $this->belongsTo(Groupsoal::class,'groupsoal_id');
	}	
	public function siswa(){
		return $this->belongsTo(Siswa::class,'siswa_id');
	}	

}
