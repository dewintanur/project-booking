<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    // Tentukan nama tabel jika tidak sesuai dengan konvensi penamaan Laravel
    protected $table = 'kategori';

    // Tentukan atribut yang dapat diisi (fillable)
    protected $fillable = ['nama'];

    // Jika ada relasi, definisikan di sini, misalnya one-to-many atau many-to-many
    public function registers()
    {
        return $this->hasMany(User::class);
    }
}
