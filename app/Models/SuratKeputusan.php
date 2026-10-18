<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeputusan extends Model
{
    protected $table = 'surat_keputusan';
    
    protected $fillable = [
        'nomor_keputusan', 'tanggal_keputusan', 'tentang', 'keterangan', 'file_lampiran', 'dibuat_oleh'
    ];

    protected function casts(): array
    {
        return ['tanggal_keputusan' => 'date'];
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}