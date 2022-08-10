<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupsoals', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('entitas_id');
			$table->foreign('entitas_id')->references('id')->on('entitas');
			$table->unsignedBigInteger('mapel_id');
			$table->foreign('mapel_id')->references('id')->on('mapels');
			$table->unsignedBigInteger('pengajar_id');
			$table->foreign('pengajar_id')->references('id')->on('pengajars');
			$table->integer('waktu')->nullable()->default(0);
			$table->date('start_date');
			$table->date('expired_date');

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
        Schema::dropIfExists('groupsoal');
    }
}
