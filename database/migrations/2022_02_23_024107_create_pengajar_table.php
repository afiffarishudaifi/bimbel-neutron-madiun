<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajars', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('noinduk',255)->nullable();
			$table->text('nama_pengajar')->nullable();
			$table->text('alamat')->nullable();
			$table->string('tempat_lahir',255)->nullable();
			$table->date('tanggal_lahir');
			$table->string('foto',255)->nullable();

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
        Schema::dropIfExists('pengajar');
    }
}
