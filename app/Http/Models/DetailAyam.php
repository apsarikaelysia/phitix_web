<?php

namespace App\Models;

use App\Models\Ayam;
use App\Models\PengeluaranAyam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailAyam extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_pengeluaran_ayam';

    protected $fillable =
        [
            'id_ayam',
            'id_pengeluaran_ayam',
        ];

    public function ayam()
    {
        return $this->belongsTo(Ayam::class, 'id_ayam', 'id');
    }

    public function pengeluaranayam()
    {
        return $this->belongsTo(PengeluaranAyam::class, 'id_pengeluaran_ayam', 'id');
    }
}