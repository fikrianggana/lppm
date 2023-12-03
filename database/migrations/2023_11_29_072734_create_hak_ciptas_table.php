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
        Schema::create('hak_ciptas', function (Blueprint $table) {
            $table->string('hcp_id')->primary();
            $table->string('hcp_namalengkap');
            $table->string('hcp_judul');
            $table->string('hcp_noapk');
            $table->integer('hcp_sertifikat');
            $table->string('hcp_keterangan');
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
        Schema::dropIfExists('hak_ciptas');
    }
};
