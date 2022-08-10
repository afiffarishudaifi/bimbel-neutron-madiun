<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $guarded = [];

	public function kelas(){
		return $this->belongsTo(Kelas::class,'kelas_id');
	}
	public function mapel(){
		return $this->belongsTo(Mapel::class,'mapel_id');
	}
	public function pengajar(){
		return $this->belongsTo(Pengajar::class,'pengajar_id');
	}

    public function post()
    {
        return $this->hasMany(Post::class,'topic_id');
    }

    public function postImages()
    {
        return $this->hasMany(Post::class,'topic_id')->limit(5)->orderBy('posts.id','DESC');
    }

}
