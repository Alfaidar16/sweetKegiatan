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
        Schema::create('galeri_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('opd_id');
            $table->string('image');
            $table->string('nama_kegiatan');
            $table->string('slug');
            $table->string('lokasi_kegiatan');
            $table->string('dasar_pelaksanaan');
            $table->text('narasi_kegiatan');
            $table->string('hari');
            $table->string('tanggal');
            $table->string('url')->nullable();
            $table->string('dokumen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri_kegiatan');
    }
};
