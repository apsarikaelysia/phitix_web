<?php

namespace App\Models;

use App\Models\DetailAyam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ayam extends Model
{
    use HasFactory;

    protected $table = 'tb_ayam';

    protected $fillable = [
        'tanggal_masuk',
        'jumlah_masuk',
        'harga_satuan',
        'total_harga',
        'mati',
        'total_ayam',
    ];

    public function detailayam()
    {
        return $this->hasMany(DetailAyam::class, 'id_ayam', 'id');
    }

}