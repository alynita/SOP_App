<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $fillable = [
        'sop_id',
        'no_urutan',
        'nama_kegiatan',
        'kelengkapan',
        'waktu',
        'output',
        'keterangan'
    ];

    // 🔥 RELASI KE SOP
    public function sop()
    {
        return $this->belongsTo(Sop::class);
    }

    // 🔥 RELASI KE PELAKSANA (PENTING BANGET)
    public function pelaksana()
    {
        return $this->belongsToMany(Pelaksana::class, 'kegiatan_pelaksana');
    }
}