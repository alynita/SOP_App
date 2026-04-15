<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keterkaitan extends Model
{
    use HasFactory;

    protected $fillable = [
        'sop_id',
        'isi'
    ];
}