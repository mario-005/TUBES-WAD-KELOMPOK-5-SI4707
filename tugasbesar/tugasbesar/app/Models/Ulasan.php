<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasans';

    protected $fillable = [
        'nama_rumah_makan',
        'nama_pengulas',
        'rating',
        'komentar',
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
