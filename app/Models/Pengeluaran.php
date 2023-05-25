<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $fillable = [
        'harga_pakan',
        'tgl_beli_pakan',
        'biaya_vaksin',
        'tgl_vaksin',
        'tenaga_kerja',
        'bibit_ayam,'
    ];

}