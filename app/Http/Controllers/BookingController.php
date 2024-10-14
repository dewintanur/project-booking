<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; // Assuming you have a Booking model
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function history()
{
    $bookings = Booking::all(); // Mengambil semua data booking

    return view('event.booking.history', compact('bookings'));
}

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'nama_event' => 'required|string|max:255',
            'kategori_event' => 'required|string',
            'kategori_ekraf' => 'required|string',
            'deskripsi_event' => 'required|string',
            'alat' => 'nullable|string',
            'jumlah' => 'nullable|integer',
            'nama_pic' => 'required|string|max:255',
            'telpon' => 'required|numeric',
            'jenis_event' => 'required|string',
            'proposal' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'banner' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Store the files (if provided)
        if ($request->hasFile('proposal')) {
            $proposalPath = $request->file('proposal')->store('proposals', 'public');
            $validatedData['proposal'] = $proposalPath;
        }

        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners', 'public');
            $validatedData['banner'] = $bannerPath;
        }

        // Save the validated data into the database
        $booking = Booking::create($validatedData);

        // Redirect or return a response
        return redirect()->route('event.booking.history')->with('success', 'Booking event berhasil disimpan!');
    }
}
