<?php

namespace App\Models;

use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelDetail extends Model
{
    use HasFactory;

    protected $table = 'level_detail';

    protected $fillable = [
        'level'
    ];

    public function userdetail()
    {
        return $this->hasOne(UserDetail::class);
    }

}