<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //data master
        Schema::create('data_master', function (Blueprint $table){
            $table->increments('id');
            $table->string('id_organisasi')->unique();
            $table->text('alatpengukuran');
            $table->text('pembacaanmeter');
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
        Schema::dropIfExists('data_master');
    }
}
