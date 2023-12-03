<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminars', function (Blueprint $table) {
            $table->string('smn_id');
            $table->string('smn_namapenulis');
            $table->string('smn_kategori');
            $table->string('smn_penyelenggara');
            $table->string('smn_waktu');
            $table->string('smn_tempatpelaksaan');
            $table->string('smn_keterangan');
            $table->foreignId('pengguna_pgn_id')->constrained();
            $table->string('smn_atribut');
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
        Schema::dropIfExists('seminars');
    }
};
