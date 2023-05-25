<?php

namespace App\Models;

use App\Models\CatatAyam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataAyam extends Model
{
    use HasFactory;

    protected $table = 'data_ayam';

    protected $fillable = [
        'tanggal_masuk',
        'jumlah_masuk',
        'harga_satuan',
        'total_harga',
        'mati',
        'total_ayam'
    ];

    public function catatayam()
    {
        return $this->hasMany(CatatAyam::class, 'id_ayam', 'id');
    }

}