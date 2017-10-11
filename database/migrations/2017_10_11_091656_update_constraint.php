<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gi', function (Blueprint $table) {
            $table->foreign('id_organisasi')
                ->references('id')
                ->on('organisasi')
                ->onDelete('cascade');
        });

        Schema::table('trafo_gi', function (Blueprint $table) {
            $table->foreign('id_organisasi')
                ->references('id')
                ->on('organisasi')
                ->onDelete('cascade');
            $table->foreign('id_gi')
                ->references('id')
                ->on('gi')
                ->onDelete('cascade');
        });

        Schema::table('penyulang', function (Blueprint $table) {
            $table->foreign('id_organisasi')
                ->references('id')
                ->on('organisasi')
                ->onDelete('cascade');
            $table->foreign('id_trafo_gi')
                ->references('id')
                ->on('trafo_gi')
                ->onDelete('cascade');
        });

        Schema::table('gardu', function (Blueprint $table) {
            $table->foreign('id_organisasi')
                ->references('id')
                ->on('organisasi')
                ->onDelete('cascade');
            $table->foreign('id_penyulang')
                ->references('id')
                ->on('penyulang')
                ->onDelete('cascade');
        });

        Schema::table('transfer', function (Blueprint $table) {
            $table->foreign('id_organisasi')
                ->references('id')
                ->on('organisasi')
                ->onDelete('cascade');
            $table->foreign('id_gi')
                ->references('id')
                ->on('gi')
                ->onDelete('cascade');
            $table->foreign('id_trafo_gi')
                ->references('id')
                ->on('trafo_gi')
                ->onDelete('cascade');
            $table->foreign('id_penyulang')
                ->references('id')
                ->on('penyulang')
                ->onDelete('cascade');
        });

        Schema::table('penyimpanan_gardu', function (Blueprint $table) {
            $table->foreign('id_gardu')
                ->references('id')
                ->on('gardu')
                ->onDelete('cascade');
        });

        Schema::table('penyimpanan_penyulang', function (Blueprint $table) {
            $table->foreign('id_penyulang')
                ->references('id')
                ->on('penyulang')
                ->onDelete('cascade');
        });

        Schema::table('penyimpanan_trafo_gi', function (Blueprint $table) {
            $table->foreign('id_trafo_gi')
                ->references('id')
                ->on('trafo_gi')
                ->onDelete('cascade');
        });

        Schema::table('penyimpanan_gi', function (Blueprint $table) {
            $table->foreign('id_gi')
                ->references('id')
                ->on('gi')
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
        //
    }
}
