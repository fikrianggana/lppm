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
        Schema::create('users', function (Blueprint $table) {
            $table->string('usr_id')->primary();
            $table->string('usr_nama');
            $table->foreignId('prodi_id')->nullable()->constrained();
            $table->string('username');
            $table->string('password');
            $table->string('usr_role');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('pgn_notelpon');
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('detail_pengabdian', function (Blueprint $table) {
            $table->id();
            $table->string('pkm_id')->constrained();
            $table->string('usr_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('detail_pengabdian');
    }
};
