<?php

namespace App\Models;

use App\Models\DetailVaksin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vaksin extends Model
{
    use HasFactory;

    protected $table = 'tb_vaksin';

    protected $fillable = [
        'tanggal_ovk',
        'jenis_ovk',
        'jumlah_ayam',
        'next_ovk',
        'biaya_ovk',
        'total_biaya',

    ];

    public function detailvaksin()
    {
        return $this->hasMany(DetailVaksin::class, 'id_vaksin', 'id');
    }

}
