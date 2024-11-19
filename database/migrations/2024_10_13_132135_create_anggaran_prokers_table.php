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
        Schema::create('anggaran_prokers', function (Blueprint $table) {
            $table->id('anggaran_proker_id');
            $table->unsignedBigInteger('anggaran_id');
            $table->unsignedBigInteger('proker_id');
            $table->integer('anggaran_proker_nominal')->default(0);
            $table->timestamps();

            $table->foreign('anggaran_id')->references('anggaran_id')->on('anggarans')->onDelete('cascade');
            $table->foreign('proker_id')->references('proker_id')->on('prokers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran_prokers');
    }
};
