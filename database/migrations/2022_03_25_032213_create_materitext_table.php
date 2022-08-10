<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateritextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materitexts', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('mapel_id');
			$table->foreign('mapel_id')->references('id')->on('mapels');
			$table->unsignedBigInteger('entitas_id');
			$table->foreign('entitas_id')->references('id')->on('entitas');
			$table->longText('text')->nullable();
			$table->integer('no_urut')->nullable()->default(0);
			$table->string('nama_materitext',255)->nullable();

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
        Schema::dropIfExists('materitext');
    }
}
