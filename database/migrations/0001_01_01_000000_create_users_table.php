<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nama pengguna
            $table->string('phone', 12);  // Nomor telepon, dengan panjang tepat 12 angka
            $table->string('email')->unique();  // Email pengguna
            $table->string('website')->nullable();  // Website pengguna (opsional)
            $table->string('facebook')->nullable();  // Facebook (opsional)
            $table->string('instagram')->nullable();  // Instagram (opsional)
            $table->string('tiktok')->nullable();  // TikTok (opsional)
            $table->string('youtube')->nullable();  // YouTube (opsional)
            $table->string('password');  // Password (hashed)
            $table->foreignId('kategori_id')->constrained('kategori');  // Kategori, terkait dengan tabel kategori
            $table->foreignId('subsektor_id')->constrained('subsektor');  // Subsektor, terkait dengan tabel subsektor
            $table->foreignId('kota_id')->constrained('kota');  // Kota, terkait dengan tabel kota
            $table->foreignId('kecamatan_id')->constrained('kecamatan');  // Kecamatan, terkait dengan tabel kecamatan
            $table->string('alamat');  // Alamat pengguna
            $table->text('deskripsi')->nullable();  // Deskripsi (opsional)
            $table->string('logo')->nullable();  // Logo, jika ada
            $table->timestamps();  // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');  // Menghapus tabel jika rollback
    }
}
