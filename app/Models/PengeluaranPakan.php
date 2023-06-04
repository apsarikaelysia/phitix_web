<?php

namespace App\Models;

use App\Models\DetailPakan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranPakan extends Model
{
    use HasFactory;

    protected $table = 'tb_pengeluaran_pakan';

    protected $fillable = [
        'tanggal',
    ];

    public function detailpakan()
    {
        return $this->hasMany(DetailPakan::class, 'id_pengeluaran_pakan', 'id');
    }

}
