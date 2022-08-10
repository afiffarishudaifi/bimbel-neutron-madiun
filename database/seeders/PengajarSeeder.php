<?php

namespace Database\Seeders;

use App\Models\Pengajar;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PengajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pengajar = Pengajar::create([
            'noinduk'=>'12345678910',
            'email'=>'pengajar2@gmail.com',
            'password'=>bcrypt('123456'),
            'nama_pengajar'=>'Arif iik haerudin S.kom, M.kom',
            'alamat'=>'cikupa',
            'tempat_lahir'=>'cikupa',
            'tanggal_lahir'=>'1995-01-10',
            'foto'=>'no-image.jpg'
        ]);
        $role = Role::create(['name' => 'Pengajar','guard_name'=>'pengajar']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $pengajar->assignRole([$role->id]);
    }
}
