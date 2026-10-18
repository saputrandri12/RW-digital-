<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('notulen', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['notulen_rapat', 'surat_keluar'])->default('notulen_rapat');
            $table->string('judul', 200);
            $table->date('tanggal');
            $table->string('nomor_surat', 100)->nullable(); // Khusus surat keluar
            $table->string('tujuan', 150)->nullable(); // Khusus surat keluar
            $table->longText('isi'); 
            $table->string('file_lampiran')->nullable();
            $table->foreignId('dibuat_oleh')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('notulen'); }
};