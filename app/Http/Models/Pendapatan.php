<?php

namespace App\Models;

use App\Models\Penghasilan;
use App\Models\DetailPendapatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendapatan extends Model
{
    use HasFactory;

    protected $table = 'tb_pendapatan';

    protected $fillable = [
        'tanggal',
    ];

    public function detailpendapatan()
    {
        return $this->hasMany(DetailPendapatan::class, 'id_pendapatan', 'id');
    }


}