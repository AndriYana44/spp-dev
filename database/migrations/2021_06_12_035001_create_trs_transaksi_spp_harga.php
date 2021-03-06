<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrsTransaksiSppHarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_transaksi_spp_harga', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('harga_spp');
            $table->integer('diskon');
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
        Schema::dropIfExists('trs_transaksi_spp_harga');
    }
}
