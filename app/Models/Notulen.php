<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    protected $table = 'notulen';
    protected $fillable = [
    'tipe', 'judul', 'tanggal', 'jam', 'lokasi', 'nomor_surat', 
    'tujuan', 'perihal', 'isi', 'keputusan', 'keterangan', 
    'file_lampiran', 'dibuat_oleh'
];
    protected function casts(): array { return ['tanggal' => 'date']; }
    
    public function pembuat() { return $this->belongsTo(User::class, 'dibuat_oleh'); }
    
    public function getTipeLabelAttribute() {
        return $this->tipe === 'notulen_rapat' ? 'Notulen Rapat' : 'Surat Keluar';
    }
}