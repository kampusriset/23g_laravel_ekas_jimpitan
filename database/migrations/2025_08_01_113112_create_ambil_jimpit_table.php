<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbilJimpitTable extends Migration
{
    public function up()
    {
        Schema::create('ambil_jimpit', function (Blueprint $table) {
        $table->bigIncrements('id_ambil');
        $table->foreignId('petugas_id')->constrained('petugas', 'id_petugas')->onDelete('cascade');
        $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade'); // <- relasi baru
        $table->dateTime('tanggal_ambil');
        $table->integer('nominal');
        $table->timestamp('created_at')->useCurrent();
    });

    }

    public function down()
    {
        Schema::dropIfExists('ambil_jimpit');
    }
}

