<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Ruangan;

class RuanganSeeder extends Seeder
{
    public function run()
    {
        $ruangans = [
            [
                'nama_ruangan' => 'Stage Outdoor',
                'lantai' => '1',
                'ukuran' => '-',
                'kapasitas' => 100,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Area Miniatur Candi Badut. Dapat digunakan untuk Konser/Jamming Session. Peralatan lain, penyelenggara membawa pribadi.',
                'gambar' => 'path/to/stage-outdoor.jpg'
            ],
            [
                'nama_ruangan' => 'Teras Tengah',
                'lantai' => '2',
                'ukuran' => '3x6 m',
                'kapasitas' => '50-100',
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Teras Tengah. Dapat digunakan untuk berbagai aktivitas.',
                'gambar' => 'path/to/teras-tengah.jpg'
            ],
            [
                'nama_ruangan' => 'Teras Utara',
                'lantai' => '2',
                'ukuran' => '7,2 x 5,4',
                'kapasitas' => 50,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Area terbuka di dekat Tangga Darurat. Dapat digunakan untuk bazaar, latihan dance/teater/catwalk, atau olahraga indoor.',
                'gambar' => 'path/to/teras-utara.jpg'
            ],
            [
                'nama_ruangan' => 'Coworking Space 1',
                'lantai' => '4',
                'ukuran' => '8,3 x 3,1',
                'kapasitas' => 6,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Ruangan tertutup dilengkapi dengan bean bag, mini table, dan sofa. Dapat digunakan untuk meeting atau mini workshop.',
                'gambar' => 'path/to/coworking-space-1.jpg'
            ],
            [
                'nama_ruangan' => 'Studio Musik & Recording',
                'lantai' => '4',
                'ukuran' => '3,1 x 8,3',
                'kapasitas' => 8,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Studio Musik dilengkapi dengan alat musik dan recording system (Hanya digunakan untuk Rekaman atau Scoring).',
                'gambar' => 'path/to/studio-musik-recording.jpg'
            ],
            [
                'nama_ruangan' => 'Workshop Seni',
                'lantai' => '4',
                'ukuran' => '16,2 x 10',
                'kapasitas' => 30,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Area Display Instalasi Seni yang dilengkapi dengan Sketsel, Pedestal dan Lampu Sorot untuk display karya.',
                'gambar' => 'path/to/workshop-seni.jpg'
            ],
            [
                'nama_ruangan' => 'Lab Komputer',
                'lantai' => '4',
                'ukuran' => '23 x 10',
                'kapasitas' => 16,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Ruangan yang dilengkapi dengan komputer. Dapat digunakan untuk Workshop Aplikasi atau Editing.',
                'gambar' => 'path/to/lab-komputer.jpg'
            ],
            [
                'nama_ruangan' => 'Open Public Space Utara',
                'lantai' => '4',
                'ukuran' => '-',
                'kapasitas' => 50-60,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Area terbuka di dekat Tangga Darurat. Dapat digunakan untuk bazaar, latihan dance/teater/catwalk, atau olahraga indoor.',
                'gambar' => 'path/to/open-public-space-utara.jpg'
            ],
            [
                'nama_ruangan' => 'Coworking Space 1',
                'lantai' => '5',
                'ukuran' => '3,1 x 8,3',
                'kapasitas' => 10,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Ruangan tertutup untuk keperluan meeting, daily working, mini conference.',
                'gambar' => 'path/to/coworking-space-1-lantai-5.jpg'
            ],
            [
                'nama_ruangan' => 'Coworking Space 2',
                'lantai' => '5',
                'ukuran' => '3,1 x 8,3',
                'kapasitas' => 10,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Ruangan tertutup untuk meeting, daily working, mini workshop.',
                'gambar' => 'path/to/coworking-space-2.jpg'
            ],
            [
                'nama_ruangan' => 'Amphitheater 1',
                'lantai' => '5',
                'ukuran' => '-',
                'kapasitas' => 150,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Ruangan Amphitheater multifungsi. Dapat digunakan untuk Pemutaran Film, Seminar, Workshop, Talkshow, Mini Konser, Lomba.',
                'gambar' => 'path/to/amphitheater-1.jpg'
            ],
            [
                'nama_ruangan' => 'Amphitheater 2',
                'lantai' => '5',
                'ukuran' => '-',
                'kapasitas' => 150,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Ruangan Amphitheater multifungsi. Dapat digunakan untuk Pemutaran Film, Seminar, Workshop, Talkshow, Mini Konser, Lomba.',
                'gambar' => 'path/to/amphitheater-2.jpg'
            ],
            [
                'nama_ruangan' => 'Studio Foto',
                'lantai' => '5',
                'ukuran' => '12,2 x 7,4',
                'kapasitas' => 20,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Studio Foto. Dilengkapi dengan kursi dan sofa serta sound system (Sound hanya Output Mic).',
                'gambar' => 'path/to/studio-foto.jpg'
            ],
            [
                'nama_ruangan' => 'Ruang Fashion',
                'lantai' => '5',
                'ukuran' => '12,2 x 7,4',
                'kapasitas' => 20,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Ruangan tertutup dilengkapi dengan mesin jahit dan mesin obras. Dapat digunakan untuk workshop atau pelatihan bidang fashion.',
                'gambar' => 'path/to/ruang-fashion.jpg'
            ],
            [
                'nama_ruangan' => 'Open Public Space Utara',
                'lantai' => '6',
                'ukuran' => '-',
                'kapasitas' => 30,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Space terbuka yang dapat digunakan untuk latihan Dance, Teater, Catwalk.',
                'gambar' => 'path/to/open-public-space-utara.jpg'
            ],
            [
                'nama_ruangan' => 'Rooftop',
                'lantai' => '8',
                'ukuran' => '-',
                'kapasitas' => 100,
                'pic' => 'Contact Marketing',
                'biaya_sewa' => 0,
                'detail_ruangan' => 'Area terbuka untuk kegiatan photoshoot dan video shoot.',
                'gambar' => 'path/to/rooftop.jpg'
            ],
        ];

        foreach ($ruangans as $ruangan) {
            Ruangan::create($ruangan);
        }
    }
}

