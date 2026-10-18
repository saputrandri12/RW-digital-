<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Update tabel Notulen
        Schema::table('notulen', function (Blueprint $table) {
            $table->time('jam')->nullable()->after('tanggal');
            $table->string('lokasi', 150)->nullable()->after('jam');
            $table->string('perihal', 200)->nullable()->after('tujuan');
            $table->text('keputusan')->nullable()->after('isi');
            $table->text('keterangan')->nullable()->after('keputusan');
        });

        // Update tabel Keputusan
        Schema::table('keputusan', function (Blueprint $table) {
            $table->string('tentang', 200)->nullable()->after('tanggal_ditetapkan');
            $table->text('keterangan')->nullable()->after('isi_keputusan');
        });
    }

    public function down(): void
    {
        Schema::table('notulen', function (Blueprint $table) {
            $table->dropColumn(['jam', 'lokasi', 'perihal', 'keputusan', 'keterangan']);
        });

        Schema::table('keputusan', function (Blueprint $table) {
            $table->dropColumn(['tentang', 'keterangan']);
        });
    }
};