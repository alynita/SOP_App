<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelaksana extends Model
{
    protected $table = 'pelaksana';

    protected $fillable = ['nama'];

    public function kegiatan()
    {
        return $this->belongsToMany(Kegiatan::class, 'kegiatan_pelaksana');
    }
}