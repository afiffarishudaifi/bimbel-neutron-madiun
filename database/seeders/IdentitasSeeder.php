<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdentitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('identitas')->insert(
            array(
            'nama_web' => 'Erendi Digital',
            'link_web' => 'http://erendi.digital',
            'about'=>'',
            'meta_desc_web' => 'Situs resmi erendi',
            'meta_key_web' => '',
            'alamat_web' => '',
            'kontak_web' => '021-0000-000',
            'fax_web' => '-',
            'email_web' => 'info@erendi.digital',
            'maps_web' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15864.963032160715!2d106.524942!3d-6.2319595!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x31d332470e8ba6ce!2sJasa%20Pembuatan%20Website%20Cikupa!5e0!3m2!1sid!2sid!4v1622695017035!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'logo_web' => 'logo.png',
            'ig_web' => '-',
            'fb_web' => '-',
            'yt_web' => '-',
            'created_at'=> date('Y-m-d H:i:s'),
            )
        );
    }
}
