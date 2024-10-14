<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'tanggal',
        'jam',
        'nama_event',
        'kategori_event',
        'kategori_ekraf',
        'ruangan',
        'deskrpsi_event',
        'jumlah_peserta',
        'nama_pic',
        'no_pic',
        'jenis_event',
        'peralatan',
        'proposal',
        'banner',
        'status', // Tambahkan status
    ];
}
