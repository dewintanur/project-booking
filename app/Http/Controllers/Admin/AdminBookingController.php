<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Booking;

use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = [
            [
                'code' => 'MCC-2409-CUMI',
                'event_name' => 'Rekaman Lagu',
                'location' => 'Studio Musik & Recording, Lantai 4',
                'date' => '05 Oct 2024 18:00 - 21:00',
                'organizer' => 'Hasbee Studio',
                'pic' => '628125685903',
                'date_requested' => '27 Sep 2024 15:24',
                'status' => 'Pending'
            ],
            [
                'code' => 'MCC-2409-GBEZ',
                'event_name' => 'Pelatihan Digital Marketing',
                'location' => 'Amphitheater 2, Lantai 5',
                'date' => '08 Oct 2024 09:00 - 13:00',
                'organizer' => 'Kelurahan Dinoyo',
                'pic' => '62551818',
                'date_requested' => '27 Sep 2024 15:14',
                'status' => 'Approved'
            ]
        ];

        return view('admin.bookings', compact('bookings'));
    }

    public function updateStatus(Request $request, $code)
    {
        // Logic to update the booking status in the database based on $code
        $newStatus = $request->input('status');
        
        // Example: Update the booking in the database (replace with real logic)
        $booking = Booking::where('code', $code)->first();
        $booking->status = $newStatus;
        $booking->save();
    
        return response()->json(['success' => true]);
    }
    
}

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Booking;

// class BookingController extends Controller
// {
//     /**
//      * Menampilkan daftar booking.
//      */
//     public function index()
//     {
//         $bookings = Booking::orderBy('created_at', 'desc')->get();
//         return view('admin.bookings', compact('bookings'));
//     }

//     /**
//      * Meng-approve booking.
//      */
//     public function approve(Request $request)
//     {
//         $request->validate([
//             'booking_id' => 'required|exists:bookings,id',
//         ]);

//         $booking = Booking::find($request->booking_id);
//         $booking->status = 'Approved';
//         $booking->save();

//         return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil di-approve.');
//     }

//     /**
//      * Menolak booking.
//      */
//     public function reject(Request $request)
//     {
//         $request->validate([
//             'booking_id' => 'required|exists:bookings,id',
//         ]);

//         $booking = Booking::find($request->booking_id);
//         $booking->status = 'Reject';
//         $booking->save();

//         return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil ditolak.');
//     }

//     /**
//      * Menampilkan halaman detail booking (optional).
//      */
//     public function show($id)
//     {
//         $booking = Booking::findOrFail($id);
//         return view('admin.booking_detail', compact('booking'));
//     }

//     /**
//      * Menampilkan halaman edit booking (optional).
//      */
//     public function edit($id)
//     {
//         $booking = Booking::findOrFail($id);
//         return view('admin.booking_edit', compact('booking'));
//     }

//     /**
//      * Update booking (optional).
//      */
//     public function update(Request $request, $id)
//     {
//         $booking = Booking::findOrFail($id);
//         // Validasi dan update data sesuai kebutuhan
//         $booking->update($request->all());

//         return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil di-update.');
//     }
// }
