<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapJimpitHarianTable extends Migration
{
    public function up()
    {
        Schema::create('rekap_jimpit_harian', function (Blueprint $table) {
            $table->bigIncrements('id_rekap');
            $table->foreignId('petugas_id')->constrained('petugas', 'id_petugas')->onDelete('cascade');
            $table->dateTime('tanggal_rekap');
            $table->integer('nominal');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rekap_jimpit_harian');
    }
}

