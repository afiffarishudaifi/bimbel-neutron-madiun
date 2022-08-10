<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthContract;

class Siswa extends Model implements AuthContract
{
    use HasFactory, Authenticatable;
    protected $table ='siswas';
    protected $guarded = [];

    public function rombel()
    {
        return $this->belongsTo(Siswa::class,'siswa_id');
    }
}
