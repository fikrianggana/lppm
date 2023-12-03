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
        Schema::create('prosidings', function (Blueprint $table) {
            $table->string('pro_id')->primary();
            $table->string('pro_namapenulis');
            $table->string('pro_judulprogram');
            $table->string('pro_judulpaper');
            $table->string('pro_kategori');
            $table->string('pro_penyelenggara');
            $table->date('pro_waktuterbit');
            $table->string('pro_tempatpelaksanaan');
            $table->string('pro_keterangan');
            $table->foreignId('pengguna_pgn_id')->constrained();
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
        Schema::dropIfExists('prosidings');
    }
};
