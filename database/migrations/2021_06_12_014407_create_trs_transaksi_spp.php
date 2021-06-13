<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsTransaksiSpp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_transaksi_spp', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi')->unique();
            $table->integer('spp');
            $table->bigInteger('bayar');
            $table->bigInteger('sisa_bayar');
            $table->string('tahun')->require();
            $table->integer('id_siswa');
            $table->integer('id_bulan');
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_pending')->default(0);
            $table->boolean('is_deleted')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('mst_bulan', function(Blueprint $table) {
            $table->increments('id');
            $table->string('bulan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trs_transaksi_spp');
        Schema::dropIfExists('mst_bulan');
    }
}
