<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subsektor extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'subsektor';

    // Atribut yang dapat diisi
    protected $fillable = ['nama'];

    // Relasi ke model lain jika ada
    public function registers()
    {
        return $this->hasMany(User::class);
    }
}
