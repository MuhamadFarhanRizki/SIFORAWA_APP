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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();

            // Pengaduan dibuat oleh warga
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Data pengaduan
            $table->string('jenis_pengaduan', 100);
            $table->string('judul', 255);
            $table->text('isi_pengaduan');

            // RW yang dipilih warga
            $table->string('rw', 10);

            // Lokasi kejadian bersifat optional
            $table->text('lokasi_kejadian')->nullable();

            // Status pengaduan
            $table->enum('status', [
                'diajukan',
                'diverifikasi',
                'diproses',
                'ditanggapi',
                'selesai'
            ])->default('diajukan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};