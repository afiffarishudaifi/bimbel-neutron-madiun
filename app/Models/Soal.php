<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    protected $fillable = ['groupsoal_id','uraian','gambar','opsia','opsib','opsic','opsid','opsie','kunci'];

	public function groupsoal(){
		return $this->belongsTo(Groupsoal::class,'groupsoal_id');
	}	

}
