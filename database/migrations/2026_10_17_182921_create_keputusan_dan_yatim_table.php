<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Daftar Keputusan
        Schema::create('keputusan_rw', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_keputusan', 100);
            $table->string('judul', 200);
            $table->date('tanggal_ditetapkan');
            $table->longText('isi_keputusan');
            $table->timestamps();
        });

        // Tabel Data Yatim & Yatim Piatu
        Schema::create('data_yatim', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade');
            $table->enum('status', ['yatim', 'piatu', 'yatim_piatu']); // Yatim: ayah wafat, Piatu: ibu wafat
            $table->string('nama_orang_tua_wafat', 100)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_yatim');
        Schema::dropIfExists('keputusan_rw');
    }
};