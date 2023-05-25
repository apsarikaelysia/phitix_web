<?php

namespace App\Models;

use App\Models\DataAyam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatatAyam extends Model
{
    use HasFactory;

    protected $table = 'catat_ayam';

    protected $fillable = [
        'id_ayam',
        'tanggal',
        'jumlah',
        'mati',
    ];

    public function datayam()
    {
        return $this->belongsTo(DataAyam::class, 'id_ayam', 'id');
    }

}