<?php

namespace App\Models;

use App\Models\DetailGaji;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranGaji extends Model
{
    use HasFactory;

    protected $table = 'tb_pengeluaran_gaji';

    protected $fillable = [
        'tanggal',
    ];

    public function detailgaji()
    {
        return $this->hasMany(DetailGaji::class, 'id_pengeluaran_gaji', 'id');
    }

}
