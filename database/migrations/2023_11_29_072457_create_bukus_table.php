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
        Schema::create('bukus', function (Blueprint $table) {
            $table->string('bku_id')->primary();
            $table->string('bku_judul');
            $table->string('bku_penulis');
            $table->string('bku_editor');
            $table->string('bku_isbn');
            $table->string('bku_penerbit');
            $table->string('bku_tahun');
            $table->foreignId('pgn_id')->constrained('penggunas', 'pgn_id')->onDelete('cascade');
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
        Schema::dropIfExists('bukus');
    }
};
