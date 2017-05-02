<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenyimpananGardusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyimpanan_gardu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_gardu')->unsigned();
            $table->string('periode');
            $table->text('data');
            $table->timestamps();
            $table->foreign('id_gardu')
              ->references('id')->on('gardu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penyimpanan_gardu');
    }
}
