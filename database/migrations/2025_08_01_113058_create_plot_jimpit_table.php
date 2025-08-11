<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlotJimpitTable extends Migration
{
    public function up()
    {
        Schema::create('plot_jimpit', function (Blueprint $table) {
            $table->id('id_plot');

            // Relasi ke petugas
            $table->unsignedBigInteger('petugas_id');
            $table->foreign('petugas_id')->references('id_petugas')->on('petugas')->onDelete('cascade');

            // Hari dan status
            $table->string('nama_hari');
            $table->boolean('is_active')->default(true); // Ganti dari enum ke boolean
            $table->boolean('is_leader')->default(false); // Ganti dari enum ke boolean

            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('plot_jimpit');
    }
}
