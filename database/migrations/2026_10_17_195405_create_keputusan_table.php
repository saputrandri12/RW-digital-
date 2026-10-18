<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('keputusan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_keputusan', 100);
            $table->string('judul', 200);
            $table->date('tanggal_ditetapkan');
            $table->longText('isi_keputusan');
            $table->string('file_lampiran')->nullable();
            $table->foreignId('dibuat_oleh')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('keputusan'); }
};