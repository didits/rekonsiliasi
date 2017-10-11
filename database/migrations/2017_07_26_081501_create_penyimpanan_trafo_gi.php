<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenyimpananTrafoGi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('penyimpanan_trafo_gi');
        Schema::create('penyimpanan_trafo_gi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_trafo_gi')->unsigned();
            $table->string('periode');
            $table->text('data');
            $table->text('data_keluar');
            $table->timestamps();
            $table->foreign('id_trafo_gi')
                ->references('id')
                ->on('trafo_gi')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penyimpanan_trafo_gi');
    }
}
