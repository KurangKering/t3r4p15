<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHasilEvaluasiTerapiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_evaluasi_terapi', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hasil_evaluasi_id');
            $table->unsignedInteger('hasil_terapi_id');
            $table->timestamps();

            $table->unique(['hasil_evaluasi_id', 'hasil_terapi_id'], 'hasil_evaluasi_terapi');


            $table->foreign('hasil_evaluasi_id')
            ->references('id')
            ->on('hasil_evaluasi')
            ->onDelete('restrict');

            $table->foreign('hasil_terapi_id')
            ->references('id')
            ->on('hasil_terapi')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_evaluasi_terapi');
    }
}
