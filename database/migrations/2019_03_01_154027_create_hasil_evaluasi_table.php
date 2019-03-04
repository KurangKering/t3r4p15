<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHasilEvaluasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_evaluasi', function (Blueprint $table) {
            $table->increments('id');
            $table->text('hasil');
            $table->date('tanggal');
            $table->unsignedInteger('terapi_anak_id');
            $table->timestamps();



              $table->foreign('terapi_anak_id')
            ->references('id')
            ->on('terapi_anak')
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
        Schema::dropIfExists('hasil_evaluasi');
    }
}
