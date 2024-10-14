<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'kota';

    // Atribut yang dapat diisi
    protected $fillable = ['nama'];

    // Relasi ke model lain
    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class);
    }

    public function registers()
    {
        return $this->hasMany(User::class);
    }
}
