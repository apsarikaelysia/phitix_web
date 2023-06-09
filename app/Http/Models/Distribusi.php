<?php

namespace App\Models;

use App\Models\DetailPendapatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Distribusi extends Model
{
    use HasFactory;

    protected $table = 'tb_distribusi';

    protected $fillable = [
        'customer',
        'tanggal',
        'contact',
        'total_ayam',
        'harga_satuan',
        'payment',
    ];

    public function detailpendapatan()
    {
        return $this->hasMany(DetailPendapatan::class, 'id_distribusi', 'id');
    }
}
