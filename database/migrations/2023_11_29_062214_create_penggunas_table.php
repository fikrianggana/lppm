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
        Schema::create('penggunas', function (Blueprint $table) {
            $table->string('pgn_id')->primary();
            $table->string('pgn_nama');
            $table->foreignId('prodi_id')->nullable()->constrained();
            $table->string('pgn_username');
            $table->string('pgn_password');
            $table->string('pgn_role');
            $table->string('pgn_email');
            $table->string('pgn_notelpon');
            $table->timestamps();
        });

        Schema::create('detail_pengabdian', function (Blueprint $table) {
            $table->id();
            $table->string('pkm_id')->constrained();
            $table->string('pgn_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penggunas');
        Schema::dropIfExists('detail_pengabdian');
    }
};
