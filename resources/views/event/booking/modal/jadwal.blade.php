<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        width: 600px; /* Lebarkan sedikit modal agar cukup untuk tanggal dan jam */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Container untuk tanggal dan jam agar tampil sejajar */
    .date-time-container {
        display: flex;
        justify-content: space-between;
        gap: 20px; /* Jarak antara tanggal dan jam */
    }

    .date-picker {
        flex: 1;
    }

    .time-options {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* Jarak antara checkbox */
    }

    .time-options label {
        display: flex;
        align-items: center;
    }

    .time-options input {
        margin-right: 5px; /* Jarak antara checkbox dan label */
    }

    /* Style untuk tombol close */
    .close {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 20px;
    }

    /* Style untuk tombol Booking */
    .btn {
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3; /* Warna saat hover */
    }
</style>

<div id="modal{{ $ruang->id }}" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('{{ $ruang->id }}')">&times;</span>
        <h2>Booking Ruangan: <span id="ruang-name{{ $ruang->id }}">{{ $ruang->nama_ruangan }}</span></h2>
        <p hidden>Lantai: <span id="lantai{{ $ruang->id }}">{{ $ruang->lantai }}</span></p>
        <p hidden>Fasilitas: <span id="fasilitas{{ $ruang->id }}">{{ $ruang->fasilitas }}</span></p>
        <p>Pilih Tanggal dan Jam</p>

        <div class="date-time-container">
            <!-- Pilih Tanggal -->
            <div class="date-picker">
                <label for="date{{ $ruang->id }}" class="block text-sm font-medium text-gray-700">Pilih Tanggal</label>
                <input type="text" id="date{{ $ruang->id }}" class="border rounded-md p-2 w-full flatpickr" readonly>
            </div>

            <!-- Pilih Jam -->
            <div class="time-options">
                <label class="block text-sm font-medium text-gray-700">Pilih Jam</label>
                <div class="time-options">
                    @for ($hour = 8; $hour <= 20; $hour++)
                        <label>
                            <input type="checkbox" name="time{{ $ruang->id }}[]" value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00 - {{ str_pad($hour + 1, 2, '0', STR_PAD_LEFT) }}:00">
                            {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00 - {{ str_pad($hour + 1, 2, '0', STR_PAD_LEFT) }}:00
                        </label>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Tombol Booking -->
        <div class="flex justify-end mt-4">
            <button onclick="handleBooking('{{ $ruang->id }}')" class="btn btn-primary">
                Booking
            </button>
        </div>
    </div>
</div>

<script>
    // Inisialisasi flatpickr
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('.flatpickr', {
            dateFormat: 'Y-m-d',
            minDate: 'today', // Mulai dari hari ini
            maxDate: new Date().fp_incr(90) // Maksimal 3 bulan dari hari ini (90 hari)
        });
    });

    // Fungsi untuk menutup modal
    function closeModal(id) {
        document.getElementById('modal' + id).style.display = 'none';
    }
</script>
