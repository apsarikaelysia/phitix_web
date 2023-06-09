<?php

namespace App\Models;

use App\Models\Pendapatan;
use App\Models\Pengeluaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penghasilan extends Model
{
    use HasFactory;

    protected $table = 'tb_penghasilan';

    protected $fillable = [
        'tanggal',
        'pendapatan',
        'pengeluaran_ayam',
        'pengeluaran_pakan',
        'pengeluaran_vaksin',
        'penghasilan',
    ];
}
