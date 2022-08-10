<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRombelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rombels', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('siswa_id');
			$table->foreign('siswa_id')->references('id')->on('siswas');
			$table->unsignedBigInteger('entitas_id');
			$table->foreign('entitas_id')->references('id')->on('entitas');

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
        Schema::dropIfExists('rombel');
    }
}
