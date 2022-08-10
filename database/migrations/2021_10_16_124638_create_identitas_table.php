<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_web', 100)->nullable();
            $table->string('link_web', 150)->nullable();
            $table->text('about')->nullable();
            $table->text('meta_desc_web')->nullable();
            $table->text('meta_key_web')->nullable();
            $table->string('alamat_web', 255)->nullable();
            $table->string('kontak_web', 15)->nullable();
            $table->string('fax_web', 20)->nullable();
            $table->string('email_web', 255)->nullable();
            $table->text('maps_web')->nullable();
            $table->string('logo_web', 255)->nullable();
            $table->string('ig_web', 150)->nullable();
            $table->string('fb_web', 150)->nullable();
            $table->string('yt_web', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identitas');
    }
}
