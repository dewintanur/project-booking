<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'nama_ruangan',
        'lantai',
        'ukuran',
        'kapasitas',
        'pic',
        'biaya_sewa',
        'fasilitas',
        'detail_ruangan',
        'gambar',
    ];
// Di model Ruang.php
public function getFasilitasAttribute($value)
{
    return json_decode($value, true); // Mengonversi JSON string menjadi array
}

    // Tambahkan relasi atau metode lain jika diperlukan
}
