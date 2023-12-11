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
        Schema::create('pengabdian_masyarakats', function (Blueprint $table) {
            $table->string('pkm_id');
            $table->string('pkm_namakegiatan');
            $table->string('pkm_jenis');
            $table->date('pkm_waktupelaksanaan');
            $table->string('pkm_personilterlibat');
            $table->string('pkm_jumlahpenerimamanfaat');
            $table->string('pkm_buktipendukung');
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
        Schema::dropIfExists('pengabdian_masyarakats');
    }
};
