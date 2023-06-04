<?php

namespace App\Models;

use App\Models\Pakan;
use App\Models\PengeluaranPakan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPakan extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_pengeluaran_pakan';

    protected $fillable =
        [
            'id_pakan',
            'id_pengeluaran_pakan',
        ];

    public function pakan()
    {
        return $this->belongsTo(Pakan::class, 'id_pakan', 'id');
    }

    public function pengeluaranpakan()
    {
        return $this->belongsTo(PengeluaranPakan::class, 'id_pengeluaran_pakan', 'id');
    }
}