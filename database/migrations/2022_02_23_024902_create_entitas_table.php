<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entitas', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('jenjang_id');
			$table->foreign('jenjang_id')->references('id')->on('jenjangs');
			$table->unsignedBigInteger('kelas_id');
			$table->foreign('kelas_id')->references('id')->on('kelas');
			$table->unsignedBigInteger('semester_id');
			$table->foreign('semester_id')->references('id')->on('semesters');

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
        Schema::dropIfExists('entitas');
    }
}
