<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entitas extends Model
{
    use HasFactory;
    protected $table = 'entitas';
    protected $fillable = ['jenjang_id','kelas_id','semester_id'];

	public function jenjang(){
		return $this->belongsTo(Jenjang::class,'jenjang_id');
	}
	public function kelas(){
		return $this->belongsTo(Kelas::class,'kelas_id');
	}
	public function semester(){
		return $this->belongsTo(Semester::class,'semester_id');
	}

    // public function audience()
    // {
    //     return $this->belongsToMany(Audience::class, 'messageaudiences')->withPivot('audience_id','perihal','isi','read','reply','reply_date','read_date');
    // }

}
