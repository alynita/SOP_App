<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DasarHukum;
use App\Models\KualifikasiPelaksana;
use App\Models\Keterkaitan;
use App\Models\Peralatan;
use App\Models\Peringatan;
use App\Models\Pencatatan;
use App\Models\Kegiatan;

class Sop extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_sop',
        'nama_sop',
        'tgl_pembuatan',
        'tgl_revisi',
        'tgl_efektif',
        'disahkan_oleh',
        'status',
        'user_id',
        'nip',
        'sop_induk_id'
    ];

    // RELASI
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dasarHukum()
    {
        return $this->hasMany(DasarHukum::class);
    }

    public function kualifikasis()
    {
        return $this->hasMany(KualifikasiPelaksana::class);
    }

    public function keterkaitans()
    {
        return $this->hasMany(Keterkaitan::class);
    }

    public function peralatans()
    {
        return $this->hasMany(Peralatan::class);
    }

    public function peringatans()
    {
        return $this->hasMany(Peringatan::class);
    }

    public function pencatatans()
    {
        return $this->hasMany(Pencatatan::class);
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }

    public function sopInduk()
    {
        return $this->belongsTo(Sop::class, 'sop_induk_id');
    }

    public function sopRevisi()
    {
        return $this->hasOne(Sop::class, 'sop_induk_id');
    }
}