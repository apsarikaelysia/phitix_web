<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPakan extends Model
{
    use HasFactory;

    protected $table = 'detail_pakan';

    protected $fillable = [
        'pembelian',
        'jenis_pakan',
        'stok_pakan',
        'harga_kg',
        'total_harga'

    ];

}