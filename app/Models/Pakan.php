<?php

namespace App\Models;

use App\Models\DetailPakan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pakan extends Model
{
    use HasFactory;

    protected $table = 'tb_pakan';


    protected $fillable = [
        'pembelian',
        'jenis_pakan',
        'stok_pakan',
        'harga_kg',
        'total_harga',
        'sisa_stok_pakan',

    ];

    public function detailpakan()
    {
        return $this->hasMany(DetailPakan::class, 'id_pakan', 'id');
    }

}