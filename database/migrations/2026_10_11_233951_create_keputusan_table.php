<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keputusans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 100)->unique();           // Nomor keputusan
            $table->string('judul', 200);                      // Judul
            $table->date('tanggal_rapat');                     // Tanggal rapat
            $table->enum('jenis_rapat', [
                'rapat_rt',
                'rapat_rw',
                'musyawarah',
                'rapat_gabungan',
                'lainnya',
            ])->default('rapat_rw');
            $table->string('lokasi', 150)->nullable();         // Lokasi rapat
            $table->text('agenda');                            // Agenda rapat
            $table->text('hasil_keputusan');                   // Hasil keputusan
            $table->text('peserta')->nullable();               // Peserta hadir
            $table->string('lampiran')->nullable();            // File lampiran
            $table->enum('status', ['draft', 'final'])->default('draft');
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keputusans');
    }
};