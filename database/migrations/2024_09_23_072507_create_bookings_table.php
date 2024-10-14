<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('nama_event');
            $table->string('kategori_event');
            $table->string('kategori_ekraf');
            $table->string('ruangan');
            $table->text('deskrpsi_event');
            $table->integer('jumlah_peserta');
            $table->string('nama_pic');
            $table->string('no_pic');
            $table->string('jenis_event');
            $table->string('peralatan');
            $table->string('proposal');
            $table->string('banner');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
