<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Booking::create([
            'tanggal' => '2024-09-10',
            'jam' => '10:00:00',
            'nama_event' => 'Alice Johnson Conference',
            'kategori_event' => 'Conference',
            'kategori_ekraf' => 'Ekraf',
            'ruangan' => 'A1',
            'deskrpsi_event' => 'Deskripsi acara Alice Johnson Conference.',
            'jumlah_peserta' => 50,
            'nama_pic' => 'Alice Johnson',
            'no_pic' => '081234567890',
            'jenis_event' => 'Business',
            'peralatan' => 'Projector, Sound System',
            'proposal' => 'proposal-alice.pdf',
            'banner' => 'banner-alice.jpg',
            'status' => 'Booking',
        ]);

        Booking::create([
            'tanggal' => '2024-09-12',
            'jam' => '14:00:00',
            'nama_event' => 'Bob Smith Workshop',
            'kategori_event' => 'Workshop',
            'kategori_ekraf' => 'Ekraf',
            'ruangan' => 'B2',
            'deskrpsi_event' => 'Deskripsi acara Bob Smith Workshop.',
            'jumlah_peserta' => 30,
            'nama_pic' => 'Bob Smith',
            'no_pic' => '082345678901',
            'jenis_event' => 'Educational',
            'peralatan' => 'Whiteboard, Markers',
            'proposal' => 'proposal-bob.pdf',
            'banner' => 'banner-bob.jpg',
            'status' => 'Approved',
        ]);

        Booking::create([
            'tanggal' => '2024-09-15',
            'jam' => '09:00:00',
            'nama_event' => 'Carol Williams Seminar',
            'kategori_event' => 'Seminar',
            'kategori_ekraf' => 'Ekraf',
            'ruangan' => 'C3',
            'deskrpsi_event' => 'Deskripsi acara Carol Williams Seminar.',
            'jumlah_peserta' => 100,
            'nama_pic' => 'Carol Williams',
            'no_pic' => '083456789012',
            'jenis_event' => 'Academic',
            'peralatan' => 'Microphone, Projector',
            'proposal' => 'proposal-carol.pdf',
            'banner' => 'banner-carol.jpg',
            'status' => 'Reject',
        ]);
    }
}
