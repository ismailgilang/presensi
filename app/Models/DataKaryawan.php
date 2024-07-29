<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKaryawan extends Model
{
    use HasFactory;
    protected $table = 'data_karyawan';
    protected $fillable = [
        'nik',
        'name',
        'jabatan',
        'area',
        'status',
        'bpjskt',
        'bpjskn',
        'tanggal',
        'created_at',
    ];
}
