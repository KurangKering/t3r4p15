<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerapiAnakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terapi_anak', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->unsignedInteger('terapi_id');
            $table->unsignedInteger('terapis_id');
            $table->unsignedInteger('anak_id');
            $table->timestamps();


            $table->foreign('terapi_id')
            ->references('id')
            ->on('terapi')
            ->onDelete('restrict');


            $table->foreign('terapis_id')
            ->references('id')
            ->on('terapis')
            ->onDelete('restrict');

            $table->foreign('anak_id')
            ->references('id')
            ->on('anak')
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
        Schema::dropIfExists('terapi_anak');
    }
}
