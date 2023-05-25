<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    use HasFactory;

    protected $table = 'distribusi';

    protected $fillable = [
        'customer',
        'tanggal_distribusi',
        'contact',
        'harga_satuan',
        'payment',
        'address',
    ];

}