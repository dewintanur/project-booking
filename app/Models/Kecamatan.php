<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'kecamatan';

    // Atribut yang dapat diisi
    protected $fillable = ['nama', 'kota_id'];

    // Relasi ke model `Kota`
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    // Relasi ke model `Register`
    public function registers()
    {
        return $this->hasMany(User::class);
    }
}
