<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $table='tb_role';

    protected $fillable = [
        'nama',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id_role', 'id');
    }
}
