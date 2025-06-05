<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahMakan extends Model
{
    use HasFactory;

    // Allow mass-assignment only for these fields
    protected $fillable = [
        'nama', 
        'alamat', 
        'kontak', 
        'kategori',
        'jam_buka',
        'jam_tutup',
        'foto'
    ];
}
