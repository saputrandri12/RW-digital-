<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keputusan extends Model
{
    use SoftDeletes;

    protected $table = 'keputusan';

    protected $fillable = [
        'nomor', 
        'judul', 
        'tanggal_rapat', 
        'jenis_rapat', 
        'lokasi', 
        'agenda', 
        'hasil_keputusan', 
        'peserta', 
        'lampiran', 
        'status', 
        'dibuat_oleh'
    ];
    
    protected function casts(): array
    {
        return [
            'tanggal_rapat' => 'date',
        ];
    }

    // ============ RELASI ============
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    // ============ ACCESSOR ============
    public function getJenisRapatLabelAttribute()
    {
        return match ($this->jenis_rapat) {
            'rapat_rt'        => 'Rapat RT',
            'rapat_rw'        => 'Rapat RW',
            'musyawarah'      => 'Musyawarah',
            'rapat_gabungan'  => 'Rapat Gabungan',
            default           => 'Lainnya',
        };
    }

    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'draft' => 'bg-secondary',
            'final' => 'bg-success',
            default => 'bg-secondary',
        };
    }

    public function getLampiranUrlAttribute()
    {
        return $this->lampiran ? asset('storage/' . $this->lampiran) : null;
    }

    // ============ BOOT ============
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($k) {
            if (empty($k->nomor)) {
                $k->nomor = static::generateNomor();
            }
        });
    }

    protected static function generateNomor()
    {
        $tahun = now()->format('Y');
        $bulanRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'][now()->month - 1];
        $prefix = 'SK-RW07-' . $bulanRomawi . '-' . $tahun;

        $last = static::where('nomor', 'like', $prefix . '%')
            ->orderBy('nomor', 'desc')->first();

        $nomor = $last ? ((int) substr($last->nomor, -3)) + 1 : 1;

        return 'SK-RW07-' . str_pad($nomor, 3, '0', STR_PAD_LEFT) . '/' . $bulanRomawi . '/' . $tahun;
    }
}