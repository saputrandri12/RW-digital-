<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataYatim extends Model
{
    protected $table = 'data_yatim';
    
    protected $fillable = [
        'warga_id', 'status', 'nama_orang_tua_wafat', 'keterangan'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'yatim' => 'Yatim (Ayah Wafat)',
            'piatu' => 'Piatu (Ibu Wafat)',
            'yatim_piatu' => 'Yatim Piatu (Keduanya)',
            default => $this->status,
        };
    }
}