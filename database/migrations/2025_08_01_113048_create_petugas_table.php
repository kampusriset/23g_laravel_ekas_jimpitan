<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetugasTable extends Migration
{
    public function up()
    {
        Schema::create('petugas', function (Blueprint $table) {
            $table->id('id_petugas');
            $table->enum('is_active', ['0', '1'])->default(1);
            $table->string('nama_lengkap', 50);
            $table->enum('gender', ['M', 'F']);
            $table->timestamps();
            $table->timestamp('last_activity')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('petugas');
    }
}

