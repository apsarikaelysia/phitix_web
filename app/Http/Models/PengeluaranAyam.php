<?php

namespace App\Models;

use App\Models\DetailAyam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranAyam extends Model
{
    use HasFactory;

    protected $table = 'tb_pengeluaran_ayam';

    protected $fillable = [
        'tanggal',
    ];

    public function detailayam()
    {
        return $this->hasMany(DetailAyam::class, 'id_pengeluaran_ayam', 'id');
    }


}
