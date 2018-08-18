<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identitas', function (Blueprint $table) {
            $table->increments('id_identitas');
            $table->string('nama_instansi');
            $table->text('alamat');
            $table->string('kota');
            $table->string('telepon');
            $table->string('website');
            $table->string('keuangan');
            $table->string('logo');
            $table->integer('spp_perbulan');
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
        Schema::dropIfExists('identitas');
    }
}
