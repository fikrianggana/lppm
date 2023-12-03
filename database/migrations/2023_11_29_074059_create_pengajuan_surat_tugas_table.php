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
        Schema::create('pengajuan_surat_tugas', function (Blueprint $table) {
            $table->sring('pst_id')->primary();
            $table->sring('pst_namapengaju');
            $table->sring('pst_namasurattugas');
            $table->date('pst_masapelaksanaan');
            $table->sring('pst_buktipendukung');
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
        Schema::dropIfExists('pengajuan_surat_tugas');
    }
};
