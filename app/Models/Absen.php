<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $fillable = [
        'name',
        'image',
        'rlocation',
        'tugas',
        'nik',
        'sesi',
        'ket',
        'ket2',
        'created_at',
    ];
}
