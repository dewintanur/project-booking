<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah admin sudah ada
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin Super',
                'phone' => '081234567890',
                'email' => 'admin@example.com',
                'website' => null,
                'facebook' => null,
                'instagram' => null,
                'tiktok' => null,
                'youtube' => null,
                'password' => Hash::make('password'), // Ganti dengan password yang aman
                'kategori_id' => 1, // Pastikan ID ini ada di tabel kategori
                'subsektor_id' => 1, // Pastikan ID ini ada di tabel subsektor
                'kota_id' => 1, // Pastikan ID ini ada di tabel kota
                'kecamatan_id' => 1, // Pastikan ID ini ada di tabel kecamatan
                'alamat' => 'Alamat Admin',
                'deskripsi' => 'Deskripsi Admin',
                'logo' => null,
                'is_admin' => true,
            ]);
        }
    }
}
