<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id();

            // Pengaduan yang diberikan tanggapan
            $table->foreignId('pengaduan_id')
                  ->constrained('pengaduan')
                  ->onDelete('cascade');

            // Admin yang memberikan tanggapan
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Isi tanggapan dari admin
            $table->text('tanggapan');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tanggapan');
    }
};