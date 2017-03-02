<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Listrik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listrik', function (Blueprint $table) {
            $table->string('id_organisasi');
            $table->string('tahun_bulan');
            $table->string('tipe_listrik');
            $table->string('data')->text();
            $table->timestamp('created_at')->nullable();
            $table->foreign('id_organisasi')
                ->references('id_organisasi')
                ->on('users')
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
        Schema::dropIfExists('listrik');
    }
}
