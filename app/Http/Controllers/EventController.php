<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Subsektor;
class EventController extends Controller
{
    public function create()
    {
        return view('event.booking.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_event' => 'required|string',
            'kategori_event' => 'required|string',
            'ruangan' => 'required|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'jumlah_peserta' => 'required|integer',
            'pic' => 'required|string',
            'nomor_pic' => 'required|string',
            'proposal' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Simpan data ke database
        $event = new Event();
        $event->nama_event = $request->nama_event;
        $event->kategori_event = $request->kategori_event;
        $event->ruangan = $request->ruangan;
        $event->tanggal = $request->tanggal;
        $event->jam_mulai = $request->jam_mulai;
        $event->jam_selesai = $request->jam_selesai;
        $event->jumlah_peserta = $request->jumlah_peserta;
        $event->pic = $request->pic;
        $event->nomor_pic = $request->nomor_pic;

        // Jika ada file proposal, simpan file dan ambil path-nya
        if ($request->hasFile('proposal')) {
            $filePath = $request->file('proposal')->store('proposals', 'public');
            $event->proposal = $filePath;
        }

        $event->save();

        return redirect()->back()->with('success', 'Booking berhasil disimpan');
    }
    public function subsektor()
    {
        // Ambil semua data subsektor dari database
        $subsectors = Subsektor::all();

        return view('event.booking.create', compact('subsectors'));
    }
}


