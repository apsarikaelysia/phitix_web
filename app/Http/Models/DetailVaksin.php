<?php

namespace App\Models;

use App\Models\Vaksin;
use App\Models\PengeluaranVaksin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailVaksin extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_pengeluaran_vaksin';

    protected $fillable =
        [
            'id_vaksin',
            'id_pengeluaran_vaksin',
        ];

    public function vaksin()
    {
        return $this->belongsTo(Vaksin::class, 'id_vaksin', 'id');
    }

    public function pengeluaranvaksin()
    {
        return $this->belongsTo(PengeluaranVaksin::class, 'id_pengeluaran_vaksin', 'id');
    }
}