<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matericategory extends Model
{
    use HasFactory;
    protected $table = 'matericategorys';
    protected $guarded = [];
    public function kelas(){
		return $this->belongsTo(Kelas::class,'kelas_id');
	}
    public function mapel(){
		return $this->belongsTo(Mapel::class,'mapel_id');
	}
}
