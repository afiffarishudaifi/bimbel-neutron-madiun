<?php

namespace Database\Seeders;

use Alza\Alza_menu\Models\MenuItems;
use Illuminate\Database\Seeder;
use Alza\Alza_menu\Models\Menus;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Public',
            'Sidemenu'
        ];
        foreach ($data as $dt) {
            Menus::create(['name'=>$dt]);
       }

    }
}
