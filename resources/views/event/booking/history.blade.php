@extends('layouts.app')

@section('content')
    <header class="text-center">
        <p class="text-3xl pt-5">Booking Ruangan</p>
    </header>

    <!-- Tambahkan kelas container dan justify-content-center -->
    <div class="container d-flex justify-content-center py-4">
        <table class="text-center table table-bordered shadow-sm">
            <thead class="table-light">
                <tr>
                    <th class="text-center p-2">Kode Booking</th>
                    <th class="text-center p-2">Nama Event</th>
                    <th class="text-center p-2">Ruang dan Waktu</th>
                    <th class="text-center p-2">Tanggal Permintaan</th>
                    <th class="text-center p-2">Status</th>
                    <th class="text-center p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $bookings = [
                        ['code' => 1, 'name' => 'Alice Johnson', 'placeTime' => 'Monday', 'date' => '2000-09-08', 'status' => 'Reject'],
                        ['code' => 2, 'name' => 'Bob Smith', 'placeTime' => 'Sunday', 'date' => '2000-11-08', 'status' => 'Approved'],
                        ['code' => 3, 'name' => 'Carol Williams', 'placeTime' => 'Friday', 'date' => '1999-02-23', 'status' => 'Booking'],
                    ];
                @endphp

                @if (count($bookings) > 0)
                    @foreach ($bookings as $booking)
                        <tr class="border-none shadow-sm mb-4">
                            <td class="p-2 text-center">{{ $booking['code'] }}</td>
                            <td class="p-2 text-center">{{ $booking['name'] }}</td>
                            <td class="p-2 text-center">{{ $booking['placeTime'] }}</td>
                            <td class="p-2 text-center">{{ $booking['date'] }}</td>
                            <td class="p-2 text-center">
                                <div class="
                                    {{ 
                                        $booking['status'] === 'Approved' ? 'bg-success text-white font-bold p-1 rounded' : 
                                        ($booking['status'] === 'Reject' ? 'bg-danger text-white p-1 rounded' : 
                                        ($booking['status'] === 'Booking' ? 'bg-secondary text-white p-1 rounded' : ''))
                                    }}">
                                    {{ $booking['status'] }}
                                </div>
                            </td>

                            <td class="p-2 text-center">
    <button 
        class="btn btn-warning hover:bg-blue-700 text-black py-1 px-4 border border-blue-700 rounded
        {{ $booking['status'] === 'Approved' || $booking['status'] === 'Reject' ? 'bg-gray-400 cursor-not-allowed' : '' }}"
        data-bs-toggle="modal" 
        data-bs-target="#editModal" 
        data-code="{{ $booking['code'] }}" 
        data-name="{{ $booking['name'] }}" 
        data-place="{{ $booking['placeTime'] }}" 
        data-date="{{ $booking['date'] }}" 
        data-status="{{ $booking['status'] }}"
        {{ $booking['status'] === 'Approved' || $booking['status'] === 'Reject' ? 'disabled' : '' }}>
        <i class="fas fa-pencil-alt"></i> <!-- Icon Pensil -->
    </button>
</td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center p-4 text-gray-600">
                            Tidak ada data booking
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    
    <!-- Modal untuk Edit Detail Booking -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="edit-booking-form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Detail Booking</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-code" class="form-label">Kode Booking</label>
                            <input type="text" class="form-control" id="edit-code" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Nama Event</label>
                            <input type="text" class="form-control" id="edit-name">
                        </div>
                        <div class="mb-3">
                            <label for="edit-place" class="form-label">Ruang dan Waktu</label>
                            <input type="text" class="form-control" id="edit-place">
                        </div>
                        <div class="mb-3">
                            <label for="edit-date" class="form-label">Tanggal Permintaan</label>
                            <input type="date" class="form-control" id="edit-date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" id="save-changes">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editModal = document.getElementById('editModal');
        let selectedRow = null;

        editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            selectedRow = button.closest('tr');

            const code = button.getAttribute('data-code');
            const name = button.getAttribute('data-name');
            const place = button.getAttribute('data-place');
            const date = button.getAttribute('data-date');
            const status = button.getAttribute('data-status');

            // Mengisi form modal dengan data yang ada
            editModal.querySelector('#edit-code').value = code;
            editModal.querySelector('#edit-name').value = name;
            editModal.querySelector('#edit-place').value = place;
            editModal.querySelector('#edit-date').value = date;
        });

        document.getElementById('save-changes').addEventListener('click', function() {
            const name = editModal.querySelector('#edit-name').value;
            const place = editModal.querySelector('#edit-place').value;
            const date = editModal.querySelector('#edit-date').value;

            // Update data di tabel setelah disimpan
            selectedRow.querySelector('td:nth-child(2)').textContent = name;
            selectedRow.querySelector('td:nth-child(3)').textContent = place;
            selectedRow.querySelector('td:nth-child(4)').textContent = date;

            // Tutup modal
            const modal = bootstrap.Modal.getInstance(editModal);
            modal.hide();
        });
    });
</script>
@endsection
