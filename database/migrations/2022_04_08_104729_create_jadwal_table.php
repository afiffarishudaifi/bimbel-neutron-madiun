<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('kelas_id');
			$table->foreign('kelas_id')->references('id')->on('kelas');
			$table->unsignedBigInteger('mapel_id');
			$table->foreign('mapel_id')->references('id')->on('mapels');
			$table->string('hari',255)->nullable();
			$table->string('dari_jam',255)->nullable();
			$table->string('sampai_jam',255)->nullable();

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
        Schema::dropIfExists('jadwal');
    }
}
