<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstSiswaDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_siswa_detail', function (Blueprint $table) {
            $table->id();
            $table->string('kota_lahir');
            $table->string('agama');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('dusun');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('pos');
            $table->string('transportasi');
            $table->unsignedInteger('id_siswa');
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
        Schema::dropIfExists('mst_siswa_detail');
    }
}
