<?php

namespace App\Models;

use App\Models\DetailGaji;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'tb_gaji';
    protected $fillable = [
        'nama_karyawan',
        'jabatan',
        'gaji',
        'tanggal',
    ];

    public function detailgaji()
    {
        return $this->hasMany(DetailGaji::class, 'id_gaji', 'id');
    }
}
