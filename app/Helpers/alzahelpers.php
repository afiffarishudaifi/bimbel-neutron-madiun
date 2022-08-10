<?php
namespace App\Helpers;
use App\Models\Identitas;

class AlzaHelpers
{
    public static function title(){
        $iden = Identitas::select('nama_web')->where('id',1)->first();
        return $iden->nama_web;
    }

    public static function logo()
    {
        $iden = Identitas::select('logo_web')->where('id',1)->first();
        return url('/storage/logo/'.$iden->logo_web);
    }

    public static function about()
    {
        $iden = Identitas::select('about')->where('id',1)->first();
        return $iden->about;
    }

    public static function alamat()
    {
        $iden = Identitas::select('alamat_web')->where('id',1)->first();
        return $iden->alamat_web;
    }

    public static function kontak()
    {
        $iden = Identitas::select('kontak_web')->where('id',1)->first();
        return $iden->kontak_web;
    }

    public static function ig()
    {
        $iden = Identitas::select('ig_web')->where('id',1)->first();
        return $iden->ig_web;
    }

    public static function fb()
    {
        $iden = Identitas::select('fb_web')->where('id',1)->first();
        return $iden->fb_web;
    }

    public static function yt()
    {
        $iden = Identitas::select('yt_web')->where('id',1)->first();
        return $iden->yt_web;
    }


    public static function greeting() {
        //mengatur zona waktu
        date_default_timezone_set("Asia/Jakarta");
        //variables
        $welcome_string="Welcome!";
        $numeric_date=date("G");
        //kondisioal untuk menampilkan ucapan menurut waktu/jam
        if($numeric_date>=0&&$numeric_date<=11)
        $welcome_string="Selamat pagi!";
        else if($numeric_date>=12&&$numeric_date<=14)
        $welcome_string="Selamat siang!";
        else if($numeric_date>=15&&$numeric_date<=17)
        $welcome_string="Selamat sore!";
        else if($numeric_date>=18&&$numeric_date<=23)
        $welcome_string="Selamat malam!";
        echo "$welcome_string";
    }

    public static function cetak($str){
        return strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8'));
    }

    public static function cetak_meta($str,$mulai,$selesai){

        return strip_tags(html_entity_decode(substr(str_replace('"','',$str),$mulai,$selesai), ENT_COMPAT, 'UTF-8'));
    }

    function tanggal_indonesia($tgl){
        if ($tgl == '') {
            return '';
        }else{
        $tanggal = date_format(date_create($tgl),'Y-m-d');
        $bulan = array (
            1 =>   	'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
            );

            $var = explode('-', $tanggal);

            return $var[2] . ' ' . $bulan[ (int)$var[1] ] . ' ' . $var[0];
        }
    }

    public static function seo_title($s) {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','–');
        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
    }

    public static function buildMenu($array)
    {

        foreach ($array as $item)
        {
            echo '<li class="nav-item" id="'.$item['id'].'"><a '.(!empty($item['child']) ? "class=\"nav-link with-sub\"" : "class=\"nav-link\"").' href="'.(!empty($item['child']) ? "#" : '/'.config('pathadmin.admin_name').$item['link']).'">';
            echo (!empty($item['child']) ? "<i class=\"livicon-evo inline-block\" data-options=\"name: ".$item['class'].".svg;size: 23px;style: filled;strokeColor: #747474;fillColor: #decfff;drawDelay: 0.5;drawOnViewport: true\"></i>" : "").(!empty($item['child']) ? "<span>".$item['label']."</span>" : ($item['depth']==0 ? "<i class=\"livicon-evo inline-block\" data-options=\"name: ".$item['class'].".svg;size: 23px;style: filled;strokeColor: #747474;fillColor: #decfff;drawDelay: 0.5;drawOnViewport: true\"></i>".$item['label'] : $item['label'])).'</a>';
            if (!empty($item['child'])){
                echo '<ul class="nav-sub">';
                    (new AlzaHelpers)->buildMenu($item['child']);
                echo '</ul>';
            }
            echo '</li>';
        }

    }

    function cek_terakhir($datetime, $full = false) {
        $today = time();
        $createdday= strtotime($datetime);
        $datediff = abs($today - $createdday);
        $difftext="";
        $years = floor($datediff / (365*60*60*24));
        $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours= floor($datediff/3600);
        $minutes= floor($datediff/60);
        $seconds= floor($datediff);
        //year checker
        if($difftext=="")
        {
          if($years>1)
           $difftext=$years." Tahun";
          elseif($years==1)
           $difftext=$years." Tahun";
        }
        //month checker
        if($difftext=="")
        {
           if($months>1)
           $difftext=$months." Bulan";
           elseif($months==1)
           $difftext=$months." Bulan";
        }
        //month checker
        if($difftext=="")
        {
           if($days>1)
           $difftext=$days." Hari";
           elseif($days==1)
           $difftext=$days." Hari";
        }
        //hour checker
        if($difftext=="")
        {
           if($hours>1)
           $difftext=$hours." Jam";
           elseif($hours==1)
           $difftext=$hours." Jam";
        }
        //minutes checker
        if($difftext=="")
        {
           if($minutes>1)
           $difftext=$minutes." Menit";
           elseif($minutes==1)
           $difftext=$minutes." Menit";
        }
        //seconds checker
        if($difftext=="")
        {
           if($seconds>1)
           $difftext=$seconds." Detik";
           elseif($seconds==1)
           $difftext=$seconds." Detik";
        }
        return $difftext;
    }
}
