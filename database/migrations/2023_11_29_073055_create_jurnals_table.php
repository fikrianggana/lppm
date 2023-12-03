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
        Schema::create('jurnals', function (Blueprint $table) {
            $table->string('jrn_id')->primary();
            $table->string('jrn_judulmakalah');
            $table->string('jrn_namajurnal');
            $table->string('jrn_namapersonil');
            $table->string('jrn_issn');
            $table->string('jrn_volume');
            $table->string('jrn_nomor');
            $table->string('jrn_halamanawal');
            $table->string('jrn_halamanakhir');
            $table->string('jrn_url');
            $table->string('jrn_kategori');
            $table->foreignId('pengguna_pgn_id')->constrained();
            $table->string('jrn_atribut');
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
        Schema::dropIfExists('jurnals');
    }
};
