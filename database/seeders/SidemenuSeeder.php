<?php

namespace Database\Seeders;

use Alza\Alza_menu\Models\MenuItems;
use Illuminate\Database\Seeder;

class SidemenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = [
            [
                'id' => 1,
                'label' => 'Dashboard',
                'link' => '/home',
                'parent' => 0,
                'sort' => 0,
                'class' => 'dashboard',
                'menu' => 2,
                'depth' => 0,
                'child' => array ()
            ],[
                'id' => 2,
                'label' => 'Configurasi',
                'link' => '#',
                'parent' => 0,
                'sort' => 1,
                'class' => 'gears',
                'menu' => 2,
                'depth' => 0,
            ],[
                'id' => 3,
                'label' => 'Identitas Web',
                'link' => '/iden',
                'parent' => 2,
                'sort' => 1,
                'class' => NULL,
                'menu' => 2,
                'depth' => 1,
            ],[
                'id' => 4,
                'label' => 'Menu Manger',
                'link' => '/menus',
                'parent' => 0,
                'sort' => 2,
                'class' => 'priority-low',
                'menu' => 2,
                'depth' => 0,
                'child' => array ()
            ],[
                'id' => 5,
                'label' => 'Access Management',
                'link' => '#',
                'parent' => 0,
                'sort' => 2,
                'class' => 'diagram',
                'menu' => 2,
                'depth' => 0,
            ],[
                'id' => 6,
                'label' => 'User Management',
                'link' => '/users',
                'parent' => 5,
                'sort' => 1,
                'class' => 'users',
                'menu' => 2,
                'depth' => 0,
            ],[
                'id' => 6,
                'label' => 'Roles Management',
                'link' => '/roles',
                'parent' => 5,
                'sort' => 2,
                'class' => 'users',
                'menu' => 2,
                'depth' => 0,
            ]
        ];

        MenuItems::create($menu);
    }
}
