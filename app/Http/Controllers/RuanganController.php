<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Ruangan;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;



class RuanganController extends Controller{
    public function showRuangan()
    {
        $ruangan = Ruangan::orderBy('lantai')->get();

    // Kembalikan view dengan data ruangan
    return view('event.ruangan.index', compact('ruangan'));
    }

    public function edit($id)
{
    // Temukan ruangan berdasarkan ID
    $ruangan = Ruangan::findOrFail($id);

    // Tampilkan view edit dan passing data ruangan
    return view('event.ruangan.edit', compact('ruangan'));
}
public function update(Request $request, $id)
{
    // Validasi data
    $request->validate([
        'nama_ruangan' => 'required|string|max:255',
        'lantai' => 'required|string|max:255',
        'biaya_sewa' => 'required|string|max:255',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
    ]);

    // Temukan ruangan berdasarkan ID
    $ruangan = Ruangan::findOrFail($id);

    // Update informasi ruangan
    $ruangan->nama_ruangan = $request->input('nama_ruangan');
    $ruangan->lantai = $request->input('lantai');
    $ruangan->biaya_sewa = $request->input('biaya_sewa');

    // Cek jika ada gambar baru yang diupload
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($ruangan->gambar) {
            // Logging untuk debug
            Log::info("Menghapus gambar lama: " . $ruangan->gambar);

            // Hapus gambar dari storage
            if (Storage::disk('public')->exists($ruangan->gambar)) {
                Storage::disk('public')->delete($ruangan->gambar);
            } else {
                Log::warning("Gambar lama tidak ditemukan: " . $ruangan->gambar);
            }
        }

        // Simpan gambar baru
        $path = $request->file('gambar')->store('image', 'public');
        $ruangan->gambar = $path; // Update path gambar di database
    }

    // Simpan perubahan
    $ruangan->save();

    return redirect()->route('event.ruangan.index')->with('success', 'Ruangan berhasil diperbarui!');
}
public function show($id)
{
    // Ambil data ruangan berdasarkan ID
    $ruang = Ruangan::findOrFail($id);

    // Kirim data ke view
    return view('event.ruangan.detail', compact('ruang'));
}
public function bookingRuangan(Request $request) {
    $ruangId = $request->input('ruang_id');
    $tanggal = $request->input('tanggal');
    $jam = $request->input('jam');

    // Periksa apakah ruangan sudah dibooking pada tanggal dan jam yang dipilih
    $conflictingBooking = Booking::where('ruang_id', $ruangId)
        ->where('tanggal', $tanggal)
        ->whereIn('jam_mulai', $jam) // Jika ada konflik di jam yang dipilih
        ->exists();

    if ($conflictingBooking) {
        return response()->json(['success' => false, 'message' => 'Ruangan sudah dibooking pada waktu tersebut.']);
    }

    // Jika tidak ada konflik, buat booking baru
    foreach ($jam as $timeSlot) {
        Booking::create([
            'ruang_id' => $ruangId,
            'tanggal' => $tanggal,
            'jam_mulai' => explode(' - ', $timeSlot)[0],
            'jam_selesai' => explode(' - ', $timeSlot)[1],
        ]);
    }

    return response()->json(['success' => true, 'message' => 'Booking berhasil!']);
}

}