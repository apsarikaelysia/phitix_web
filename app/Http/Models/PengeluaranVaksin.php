<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranVaksin extends Model
{
    use HasFactory;

    protected $table = 'tb_pengeluaran_vaksin';

    protected $fillable = [
        'tanggal',
    ];

    public function detailvaksin()
    {
        return $this->hasMany(DetailVaksin::class, 'id_pengeluaran_vaksin', 'id');
    }

}
