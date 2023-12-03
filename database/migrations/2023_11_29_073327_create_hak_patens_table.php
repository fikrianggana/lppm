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
        Schema::create('hak_patens', function (Blueprint $table) {
            $table->string('hpt_id');
            $table->string('hpt_namalengkap');
            $table->string('hpt_judul');
            $table->string('hpt_nopemohonan');
            $table->date('hpt_tglpelaksanaan');
            $table->date('hpt_tglpenerimaan');
            $table->string('hpt_status');
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
        Schema::dropIfExists('hak_patens');
    }
};
