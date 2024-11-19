<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id('kegiatan_id');
            $table->string('kegiatan_name');
            $table->unsignedBigInteger('anggaran_id');
            $table->unsignedBigInteger('proker_id');
            $table->date('kegiatan_tanggal');
            $table->text('kegiatan_deskripsi');
            $table->string('kegiatan_lampiran');
            $table->integer('kegiatan_nominal');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('anggaran_id')->references('anggaran_id')->on('anggarans')->onDelete('cascade');
            $table->foreign('proker_id')->references('proker_id')->on('prokers')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
