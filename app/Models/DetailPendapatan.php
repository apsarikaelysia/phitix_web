<?php

namespace App\Models;

use App\Models\Distribusi;
use App\Models\Pendapatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPendapatan extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_pendapatan';

    protected $fillable =
        [
            'id_distribusi',
            'id_pendapatan',
        ];

    public function distribusi()
    {
        return $this->belongsTo(Distribusi::class, 'id_distribusi', 'id');
    }


}
