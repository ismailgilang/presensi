<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nik',
        'jenis',
        'tanggal',
        'jam_mulai',
        'jam_berakhir',
        'status',
        'ttd1',
        'ttd2',
        'ttd3',
        'created_at'
    ];
}
