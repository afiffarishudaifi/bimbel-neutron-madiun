<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\User ;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\Access\Authorizable;
// use Spatie\Permission\Models\Role;
class Pengajar extends Model implements AuthorizableContract,AuthenticatableContract
{
    use HasFactory,Notifiable,Authenticatable,HasRoles,Authorizable;
    protected $guard_name = 'pengajar';
    protected $table = 'pengajars';
    protected $fillable = ['noinduk','nama_pengajar','alamat','tempat_lahir','tanggal_lahir','foto','password','email'];
    protected $hidden = [
        'password',
    ];
    // public function getRoleNames()
    // {
    //     return $this->belongsToMany(Role::class);

    // }
}
