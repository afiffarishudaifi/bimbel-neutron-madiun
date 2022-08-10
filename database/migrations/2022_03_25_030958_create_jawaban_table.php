<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawabans', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('groupsoal_id');
			$table->foreign('groupsoal_id')->references('id')->on('groupsoals');
			$table->unsignedBigInteger('siswa_id');
			$table->foreign('siswa_id')->references('id')->on('siswas');
			$table->text('jawab')->nullable();

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
        Schema::dropIfExists('jawaban');
    }
}
