<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenagaKerja extends Model
{
    use HasFactory;

    protected $table = 'tenaga_kerja';

    protected $fillable = [
        'nama_karyawan',
        'jabatan',
        'gaji',
        'total_gaji',
    ];

}